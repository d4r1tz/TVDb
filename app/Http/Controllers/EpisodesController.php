<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EpisodesController extends Controller
{
    public function EpisodesOverall() {
        $datas = DB::select('select a.episode_id, a.episode_title, a.episode_rel_date, a.episode_status,
                            a.season_id, b.season_id, b.season_num, b.serie_id, c.serie_id, 
                            c.serie_title from episodes a inner join seasons b on a.season_id = b.season_id
                            inner join series c on b.serie_id = c.serie_id where a.episode_status = 1');
        return view('episodesOverall')->with('datas', $datas);
    }

    public function EpisodesSpecific($id) {
        $datas = DB::select('select * from episodes where episode_status = 1 and season_id = :season_id', ['season_id' => $id]);
        return view('episodesSpecific')->with('datas', $datas);
    }

    //VIEW ADD PAGE
    public function create() {
        return view('episodesAdd');
    }
    
    //ADD FUNCTION
    public function store(Request $request) {
        $request->validate([
            'episode_id' => 'required',
            'episode_title' => 'required',
            'episode_rel_date' => 'required',
            'writer' => 'required',
            'director' => 'required',
            'season_id' => 'required'
        ]);


        DB::insert(
            'INSERT INTO episodes(episode_id, episode_title, episode_rel_date, writer, director, season_id, episode_status) VALUES (:episode_id, :episode_title, :episode_rel_date, :writer, :director, :season_id, 1)',
            [
                'episode_id' => $request->episode_id,
                'episode_title' => $request->episode_title,
                'episode_rel_date' => $request->episode_rel_date,
                'writer' => $request->writer,
                'director' => $request->director,
                'season_id' => $request->season_id
            ]
        );

        return redirect()->route('episodesOverall')->with('success', 'New Episode Added');
    }

    //VIEW EDIT PAGE
    public function edit($id) {
        $data = DB::table('episodes')->where('episode_id', $id)->first();
        return view('episodesEdit')->with('data', $data);
    }
       
    //EDIT FUNCTION
    public function update($id, Request $request) {
        $request->validate([
            'episode_id' => 'required',
            'episode_title' => 'required',
            'episode_rel_date' => 'required',
            'writer' => 'required',
            'director' => 'required',
            'season_id' => 'required'
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE episodes SET episode_id = :episode_id, episode_title = :episode_title, episode_rel_date = :episode_rel_date, writer = :writer, director=:director, season_id=:season_id WHERE episode_id = :id',
        [
            'id' => $id,
            'episode_id' => $request->episode_id,
            'episode_title' => $request->episode_title,
            'episode_rel_date' => $request->episode_rel_date,
            'writer' => $request->writer,
            'director' => $request->director,
            'season_id' => $request->season_id
        ]
        );
        return redirect()->route('episodesOverall')->with('success', 'Episode updated');
    }

    //DELETE FUNCTION, HEADS TO INDEX PAGE
    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM episodes WHERE episode_id = :episode_id', ['episode_id' => $id]);
        return redirect()->route('episodesOverall')->with('success', 'Episode Deleted');
    }

    public function softDelete($id) {
        DB::update('UPDATE episodes SET episode_status = 0 WHERE episode_id = :episode_id', ['episode_id' => $id]);
        return redirect()->route('episodesOverall')->with('success', 'Episode is Hidden');
    }
}