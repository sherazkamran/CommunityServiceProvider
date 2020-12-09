package com.example.cspandroid.user_end.adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.cspandroid.R;
import com.example.cspandroid.user_end.modals.HistoryShopModal;

import java.util.List;

public class ShopHistoryAdapter extends BaseAdapter {

    private Context context;
    private LayoutInflater inflater;
    private List<HistoryShopModal> shopModalList;

    public ShopHistoryAdapter(Context c, List<HistoryShopModal> modal) {
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
        return Long.parseLong(shopModalList.get(position).getOrderId());
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {
        if (inflater == null) {
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }
        if (convertView == null) {
            convertView = inflater.inflate(R.layout.row_item_shopping_history, null);
        }
        HistoryShopModal modal = shopModalList.get(position);

//        order_item_name order_item_price order_item_quantity order_item_sum_price  order_date  history_order_status order_total_price

        TextView order_item_name = convertView.findViewById(R.id.order_item_name);
        TextView order_item_price = convertView.findViewById(R.id.order_item_price);
        TextView order_item_quantity = convertView.findViewById(R.id.order_item_quantity);
        TextView order_item_sum_price = convertView.findViewById(R.id.order_item_sum_price);
        TextView order_date = convertView.findViewById(R.id.order_date);
        TextView history_order_status = convertView.findViewById(R.id.history_order_status);
        TextView order_total_price = convertView.findViewById(R.id.order_total_price);

        order_item_name.setText(modal.getOrder_item_name());
        order_item_price.setText(modal.getOrder_item_price());
        order_item_quantity.setText(modal.getOrder_item_quantity());
        order_item_sum_price.setText(modal.getOrder_item_sum_price());



        return convertView;
    }

}

