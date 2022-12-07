<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SeasonsController extends Controller
{
    public function SeasonsOverall() {
        $datas = DB::select('select a.season_id, a.season_num, a.season_rel_date, a.season_status, b.serie_title from seasons a inner join series b on a.serie_id = b.serie_id where season_status = 1');
        return view('seasonsOverall')->with('datas', $datas);
    }

    public function SeasonsSpecific($id) {
        $datas = DB::select('select a.season_id, a.season_num, a.season_rel_date, a.season_status, b.serie_title from seasons a inner join series b on a.serie_id = b.serie_id where a.season_status = 1 and a.serie_id = :serie_id', ['serie_id' => $id]);
        return view('seasonsSpecific')->with('datas', $datas);
    }

    //VIEW ADD PAGE
    public function create() {
        return view('seasonsAdd');
    }
    
    //ADD FUNCTION
    public function store(Request $request) {
        $request->validate([
            'season_id' => 'required',
            'season_num' => 'required',
            'season_rel_date' => 'required',
            'serie_id' => 'required'
        ]);


        DB::insert(
            'INSERT INTO seasons(season_id, season_num, season_rel_date, serie_id, season_status) VALUES (:season_id, :season_num, :season_rel_date, :serie_id, 1)',
            [
                'season_id' => $request->season_id,
                'season_num' => $request->season_num,
                'season_rel_date' => $request->season_rel_date,
                'serie_id' => $request->serie_id
            ]
        );

        return redirect()->route('seasonsOverall')->with('success', 'New Season Added');
    }

    //VIEW EDIT PAGE
    public function edit($id) {
        $data = DB::table('seasons')->where('season_id', $id)->first();
        return view('seasonsEdit')->with('data', $data);
    }
       
    //EDIT FUNCTION
    public function update($id, Request $request) {
        $request->validate([
            'season_id' => 'required',
            'season_num' => 'required',
            'season_rel_date' => 'required',
            'serie_id' => 'required'
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE seasons SET season_id = :season_id, season_num = :season_num, season_rel_date = :season_rel_date, serie_id = :serie_id WHERE season_id = :id',
        [
            'id' => $id,
            'season_id' => $request->season_id,
            'season_num' => $request->season_num,
            'season_rel_date' => $request->season_rel_date,
            'serie_id' => $request->serie_id
        ]
        );
        return redirect()->route('seasonsOverall')->with('success', 'Season updated');
    }

    //DELETE FUNCTION, HEADS TO INDEX PAGE
    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM seasons WHERE season_id = :season_id', ['season_id' => $id]);
        return redirect()->route('seasonsOverall')->with('success', 'Season Deleted');
    }

    public function softDelete($id) {
        DB::update('UPDATE seasons SET season_status = 0 WHERE season_id = :season_id', ['season_id' => $id]);
        return redirect()->route('seasonsOverall')->with('success', 'Season is hidden');
    }
}