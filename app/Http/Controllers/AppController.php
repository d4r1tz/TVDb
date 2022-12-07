<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppController extends Controller
{
    //VIEW ADD PAGE
    public function create() {
        return view('seriesAdd');
    }
    
    //ADD FUNCTION
    public function store(Request $request) {
        $request->validate([
            'serie_id' => 'required',
            'serie_title' => 'required',
            'ser_rel_year' => 'required',
            'creator' => 'required',
            'genre' => 'required',
        ]);


        DB::insert('INSERT INTO series(serie_id, serie_title, ser_rel_year, creator, genre, serie_status) VALUES (:serie_id, :serie_title, :ser_rel_year, :creator, :genre, 1)',
        [
            'serie_id' => $request->serie_id,
            'serie_title' => $request->serie_title,
            'ser_rel_year' => $request->ser_rel_year,
            'creator' => $request->creator,
            'genre' => $request->genre
        ]
        );

        return redirect()->route('seriesIndex')->with('success', 'New Series Added');
    }

    public function index() {
        $datas = DB::select('select * from series where serie_status = 1');
        return view('seriesIndex')->with('datas', $datas);
    }

    //VIEW EDIT PAGE
    public function edit($id) {
        $data = DB::table('series')->where('serie_id', $id)->first();
        return view('seriesEdit')->with('data', $data);
    }
       
    //EDIT FUNCTION
    public function update($id, Request $request) {
        $request->validate([
            'serie_id' => 'required',
            'serie_title' => 'required',
            'ser_rel_year' => 'required',
            'creator' => 'required',
            'genre' => 'required',
        ]);

        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update('UPDATE series SET serie_id = :serie_id, serie_title = :serie_title, ser_rel_year = :ser_rel_year, creator = :creator, genre = :genre WHERE serie_id = :id',
        [
            'id' => $id,
            'serie_id' => $request->serie_id,
            'serie_title' => $request->serie_title,
            'ser_rel_year' => $request->ser_rel_year,
            'creator' => $request->creator,
            'genre' => $request->genre
        ]
        );
        return redirect()->route('seriesIndex')->with('success', 'Series updated');
    }

    //DELETE FUNCTION, HEADS TO INDEX PAGE
    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::delete('DELETE FROM series WHERE serie_id = :serie_id', ['serie_id' => $id]);
        return redirect()->route('seriesIndex')->with('success', 'Series Deleted');
    }

    public function softDelete($id) {
        DB::update('UPDATE series SET serie_status = 0 WHERE serie_id = :serie_id', ['serie_id' => $id]);
        return redirect()->route('seriesIndex')->with('success', 'Series is hidden');
    }

    public function search(Request $request) {
        if($request -> has('search')) {
            $datas = DB::table('series')->where('serie_title', 'LIKE', '%' . $request->search . '%')->get();
        }
        else {
            $datas = DB::select('select * from series where serie_status = 1');
        }
        return view('seriesSpecific')->with('datas',$datas);
    }
}