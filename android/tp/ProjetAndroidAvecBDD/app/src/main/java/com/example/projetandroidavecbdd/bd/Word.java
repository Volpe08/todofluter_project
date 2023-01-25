package com.example.projetandroidavecbdd.bd;


import androidx.room.Entity;
import androidx.room.PrimaryKey;

@Entity
public class Word {
    @PrimaryKey(autoGenerate = true)
    private int id;

    private String value;

    public Word(String value) {
        this.value = value;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getValue() {
        return value;
    }

    public void setValue(String value) {
        this.value = value;
    }
}