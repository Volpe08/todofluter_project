package com.example.projetandroidavecbdd.bd;

import androidx.lifecycle.LiveData;
import androidx.room.Insert;
import androidx.room.Query;

import java.util.List;

public interface WordDAO {
    @Insert
    void insert(Word word);
    @Query('DELETE from Word')
    void deleteAll();

    @Query('SELECT count(*) from Word')
    int nbWords();

    @Query('SELECT count(*) from Word')
    LiveData<Integer> nbWordsLD();


    @Query('SELECT * from Word ORDER BY value ASC')
    LiveData<List<Word>> getAllWord();



}
