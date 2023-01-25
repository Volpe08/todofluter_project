package com.example.projetandroidavecbdd.bd;

import android.app.Application;
import android.os.AsyncTask;

import androidx.lifecycle.LiveData;
import androidx.loader.content.AsyncTaskLoader;

import java.util.List;

public class WordRepository {
    static WordDAO wordDAO;
    static LiveData<Integer> nbWord;
    private LiveData<List<Word>> allWords;

    public WordRepository(Application application) {
        Database db = Database.getDataBase(application);

        wordDAO = db.wordDAO();

        nbWord = wordDAO.nbWordsLD();
        allWords = wordDAO.getAllWord();
    }

    public void deleteAll() {
        new DeleteAsyncTask(wordDAO).execute();
    }

    private static class DeleteAsyncTask extends AsyncTask<Void, Void, Void> {
        private WordDAO wordDAO;

        public DeleteAsyncTask(WordDAO w) {
            wordDAO = w;

        }

        @Override
        protected Void doInBackground(Void... voids) {
            wordDAO.deleteAll();
            return null;
        }
    }

    public Integer getNbWord() {
        return new getNbWordsAsyncTask(wordDAO).execute().get();

    }

    private static class getNbWordsAsyncTask extends AsyncTask<Void, Void, Integer> {
        private WordDAO wordDAO;

        public getWordsAsyncTask(WordDAO w) {
            wordDAO = w;
        }

        @Override
        protected Void doInBackground(Void... voids) {
            return WordDAO.nbWords();
        }
    }

    public void insert(Word w) {
        new InsertThread(WordDAO).execute(word);

    }


}
