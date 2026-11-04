package com.example.fragment;

import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ListAdapter;
import android.widget.ListView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.ListFragment;

public class MyListFragment extends ListFragment {
    private String dataArray[];
    public MyListFragment(){
        dataArray=new  String[]{"Electronics","Grocery and Essentials","Home","Toy Shop","Fashion"};
    }

    @Override
    public void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        ListAdapter listAdapter=new ArrayAdapter<String>(getActivity(),android.R.layout.simple_list_item_1,dataArray);
        setListAdapter(listAdapter);
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        return inflater.inflate(R.layout.list_fragment,container,false);

    }

    @Override
    public void onListItemClick(@NonNull ListView l, @NonNull View v, int position, long id) {
        Toast.makeText(getActivity(),getListView().getItemAtPosition(position).toString(),Toast.LENGTH_LONG).show();
    }
}