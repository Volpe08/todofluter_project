package com.example.projetandroidavecbdd.bd;


import android.content.Context;

import androidx.room.Room;
import androidx.room.RoomDatabase;

@androidx.room.Database(entities = {Word.class}, version = 1)
public abstract class Database extends RoomDatabase {
    public abstract WordDAO wordDAO();

    private static Database INSTANCE;

    static Database getDataBase(final Context context) {
        if (INSTANCE == null) {
            synchronized (Database.class) {
                if (INSTANCE == null) {
                    INSTANCE = Room.databaseBuilder(context.getApplicationContext(), Database.class, "word_database").build();

                }
            }
        }
        return INSTANCE;
    }
}
