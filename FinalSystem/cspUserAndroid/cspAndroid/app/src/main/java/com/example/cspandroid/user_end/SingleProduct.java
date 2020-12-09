package com.example.cspandroid.user_end;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.RecyclerView;

import android.app.Activity;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.example.cspandroid.R;
import com.example.cspandroid.user_end.adapters.CartMainAdapter;
import com.example.cspandroid.user_end.adapters.ShopMainAdapter;
import com.example.cspandroid.user_end.modals.CartModal;
import com.example.cspandroid.user_end.modals.ShopModal;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;

import static com.example.cspandroid.user_end.Constants.CART_ITEMS;

public class SingleProduct extends AppCompatActivity {
    ImageView ic_plus_qty;
    ImageView ic_minus_qty;
    TextView txtvw_item_quantity;

    private CartMainAdapter cart_main_adapter;
    private List<CartModal> cartModalList;
    private RecyclerView recyclerview;

    boolean alreadyExists = false;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_single_product);

        String temp_product_id_intent;


        ic_plus_qty = (ImageView) findViewById(R.id.ic_plus_qty);
        txtvw_item_quantity = (TextView) findViewById(R.id.txtvw_item_quantity);
        ic_minus_qty = (ImageView) findViewById(R.id.ic_minus_qty);
        ic_plus_qty.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int currentQty;

                currentQty = Integer.parseInt(txtvw_item_quantity.getText().toString());
                currentQty = currentQty + 1;
                String changedQty = Integer.toString(currentQty);
                txtvw_item_quantity.setText(changedQty);
            }
        });

        ic_minus_qty.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                int currentQty;

                currentQty = Integer.parseInt(txtvw_item_quantity.getText().toString());
                if (currentQty <= 1) {

                } else {
                    currentQty = currentQty - 1;
                    String changedQty = Integer.toString(currentQty);
                    txtvw_item_quantity.setText(changedQty);
                }
            }
        });


        Intent inn = getIntent();

        temp_product_id_intent = inn.getStringExtra("idOfProduct");
        String strName = inn.getStringExtra("nameOfItem");
        String strDesc = inn.getStringExtra("descOfItem");
        String strPrice = inn.getStringExtra("priceOfItem");
        String strImage = inn.getStringExtra("uriOfItemImage");
        Uri actualPath = Uri.parse(strImage);

        ImageView item_img_single_product = findViewById(R.id.item_img_single_product);
        Picasso.get().load(actualPath).into(item_img_single_product);
        TextView item_name_single_product = findViewById(R.id.item_name_single_product);
        item_name_single_product.setText(strName);
        TextView item_description_single_product = findViewById(R.id.item_description_single_product);
        item_description_single_product.setText(strDesc);
        TextView item_price_single_product = findViewById(R.id.item_price_single_product);
        item_price_single_product.setText(strPrice);
        TextView item_id_single_product = findViewById(R.id.id_single_product);
        item_id_single_product.setText(temp_product_id_intent);

//        gridView = findViewById(R.id.grid_view);
//
//        cartModalList = new ArrayList<>();
//        cart_main_adapter = new CartMainAdapter(SingleProduct.this, cartModalList);
//        gridView.setAdapter(main_adapter);
//


    }

    public void clickPayBills(View view) {
        redirectActivity(this, PayBills.class);
    }

    public void gotoCart(View view) {
        redirectActivity(this, Cart.class);
    }


    public void addToCart(View view) {

        int selectedQty;
        selectedQty = Integer.parseInt(txtvw_item_quantity.getText().toString());
        if (selectedQty <= 0) {
            Toast.makeText(this, "Invalid quantity!", Toast.LENGTH_SHORT).show();
        } else {
//              Quick conversion to string from int....
//            int number = -782;
//            String numberAsString = "" + number;

            TextView item_name_single_product = findViewById(R.id.item_name_single_product);
            TextView item_price_single_product = findViewById(R.id.item_price_single_product);
            TextView item_id_single_product = findViewById(R.id.id_single_product);
            TextView txtvw_item_quantity = findViewById(R.id.txtvw_item_quantity);


            String insp = item_name_single_product.getText().toString();
            String ipsp = item_price_single_product.getText().toString();
            String pii = item_id_single_product.getText().toString();
            String tiq = txtvw_item_quantity.getText().toString();

            int qty = Integer.parseInt(tiq);
            int prc = Integer.parseInt(ipsp);
            String nme = insp;
            int sum_prc = qty * prc;

            String quantity = Integer.toString(qty);
            String sumPrice = Integer.toString(sum_prc);

//              q,p,i,n,s

            for (int i = 0; i < CART_ITEMS.size(); i++) {
                CartModal crt_modal_check = CART_ITEMS.get(i);
                int pro_id_added = Integer.parseInt(crt_modal_check.getProduct_id());
                int pro_id_to_add = Integer.parseInt(pii);
                if (pro_id_added == pro_id_to_add) {
                    alreadyExists = true;
                }
            }
            if (alreadyExists == true) {
                Toast.makeText(this, "Already exists in Cart!", Toast.LENGTH_LONG).show();
            } else if (alreadyExists == false) {
                CartModal crt_modal = new CartModal();
                crt_modal.setProduct_id(pii);
                crt_modal.setProduct_name(insp);
                crt_modal.setProduct_price(ipsp);
                crt_modal.setProduct_quantity(quantity);
                crt_modal.setSum_price(sumPrice);
                Constants.CART_ITEMS.add(crt_modal);

//            Toast.makeText(this, "Quantity: " + qty + ":: Item Price: " + prc + ":: Product ID: " + pii + ":: Name: " + nme + ":: Sum Price: " + sum_prc + ":: Added successfully!", Toast.LENGTH_LONG).show();

                Toast.makeText(this, "Added to Cart!", Toast.LENGTH_LONG).show();

            }

        }


    }

    public static void redirectActivity(Activity activity, Class aClass) {
        Intent intent = new Intent(activity, aClass);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        activity.startActivity(intent);

    }


}