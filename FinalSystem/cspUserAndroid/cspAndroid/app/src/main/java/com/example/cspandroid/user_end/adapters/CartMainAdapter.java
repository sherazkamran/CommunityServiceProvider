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
import com.example.cspandroid.user_end.DeleteCartItemInterface;
import com.example.cspandroid.user_end.modals.CartModal;
import com.example.cspandroid.user_end.modals.ShopModal;
import com.squareup.picasso.Picasso;

import java.net.URI;
import java.util.List;

public class CartMainAdapter extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private List<CartModal> cartModalList;
    private DeleteCartItemInterface deleteCartItemInterface;
    public CartMainAdapter(Context c, List<CartModal> modal, DeleteCartItemInterface deleteCartItemInterface) {
        context = c;
        cartModalList = modal;
        this.deleteCartItemInterface = deleteCartItemInterface;
    }

    @Override
    public int getCount() {
        return cartModalList.size();
    }

    @Override
    public Object getItem(int position) {
        return cartModalList.get(position);
    }

    @Override
    public long getItemId(int position) {
        return Long.parseLong(cartModalList.get(position).getProduct_id());
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.row_item_cart, null);
        }

//        cart_product_name cart_product_price cart_product_quantity cart_product_sum_price

        TextView cart_product_name = convertView.findViewById(R.id.cart_product_name);
        TextView cart_product_price = convertView.findViewById(R.id.cart_product_price);
        TextView cart_product_quantity = convertView.findViewById(R.id.cart_product_quantity);
        TextView cart_product_sum_price = convertView.findViewById(R.id.cart_product_sum_price);
        TextView id_product_cart_row = convertView.findViewById(R.id.id_product_cart_row);
        ImageView image = convertView.findViewById(R.id.icon_remove_cart_item);
        CartModal modal = cartModalList.get(position);
        image.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                deleteCartItemInterface.delete(position);

            }
        });
        id_product_cart_row.setText(modal.getProduct_id());
        cart_product_name.setText(modal.getProduct_name());
        cart_product_price.setText(modal.getProduct_price());
        cart_product_quantity.setText(modal.getProduct_quantity());
        cart_product_sum_price.setText(modal.getSum_price());


        return convertView;
    }

}

