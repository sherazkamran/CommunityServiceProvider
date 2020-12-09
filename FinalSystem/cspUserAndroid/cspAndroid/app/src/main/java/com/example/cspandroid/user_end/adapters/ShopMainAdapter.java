package com.example.cspandroid.user_end.adapters;

import android.content.Context;
import android.net.Uri;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.cspandroid.R;
import com.example.cspandroid.user_end.modals.ShopModal;
import com.squareup.picasso.Picasso;

import java.net.URI;
import java.util.List;

public class ShopMainAdapter extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private List<ShopModal> shopModalList;

    public ShopMainAdapter(Context c, List<ShopModal> modal) {
        context = c;
        shopModalList = modal;
    }

    @Override
    public int getCount() {
        return shopModalList.size();
    }

    @Override
    public Object getItem(int position) {
        return shopModalList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return shopModalList.get(position).getProduct_id();
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.row_item_groceries, null);
        }

        ImageView cv_img1 = convertView.findViewById(R.id.cv_img1);
        TextView cv_img1_name = convertView.findViewById(R.id.cv_img1_name);

        ShopModal modal = shopModalList.get(position);
        String outerPath = "http://192.168.43.198/cspManager/" + modal.getImage();
        Uri actualPath = Uri.parse(outerPath);
        Picasso.get().load(actualPath).into(cv_img1);
        cv_img1_name.setText(modal.getName());


        return convertView;
    }
}
