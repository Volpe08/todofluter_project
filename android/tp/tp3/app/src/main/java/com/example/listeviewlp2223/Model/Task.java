package com.example.listeviewlp2223.Model;

public class Task {

    private int id;
    private String title;
    private String description;
    private boolean complete;

    public Task(int id, String title, String description, boolean complete) {
        this.id = id;
        this.title = title;
        this.description = description;
        this.complete = complete;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public boolean iscomplete() {
        return complete;
    }

    public void setcomplete(boolean complete) {
        this.complete = complete;
    }
}
