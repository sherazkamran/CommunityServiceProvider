package com.example.cspandroid.user_end;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.view.View;
import android.os.Bundle;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cspandroid.R;
import com.example.cspandroid.user_end.adapters.CartMainAdapter;
import com.example.cspandroid.user_end.modals.CartModal;
import com.google.android.material.floatingactionbutton.FloatingActionButton;


import androidx.annotation.Nullable;
import androidx.core.view.GravityCompat;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.widget.Button;
import android.widget.EditText;
import android.widget.GridView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;


import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

import static com.example.cspandroid.user_end.Constants.CART_ITEMS;
import static com.example.cspandroid.user_end.Constants.URL;
import static com.example.cspandroid.user_end.Constants.logged_in_user_id;


public class Cart extends AppCompatActivity implements DeleteCartItemInterface{


    private DrawerLayout var_drawer_layout;
    private FloatingActionButton fab_ic_more;
    private LinearLayout all_shop_cat;
    private LinearLayout layout_cat_name;
    private Button btn_shop_cat_g;
    private TextView txtvw_order_sum_price, id_product_cart_row;
    private EditText order_dest_address;
    private CartMainAdapter cart_main_adapter;

    private GridView cartgridview;

    String pid, pnm, pprc, pqty, spprc, uid, ostt, stringOid, date, dest_address;
    int currentListPosition, oid, random, total_price, sum_product_price, order_total_price, z;
    boolean match;

    //cart_recycler
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cart);
        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_cart);

        cartgridview = findViewById(R.id.cart_grid);

        cart_main_adapter = new CartMainAdapter(Cart.this, CART_ITEMS, this);
        cartgridview.setAdapter(cart_main_adapter);

        txtvw_order_sum_price = findViewById(R.id.txtvw_order_sum_price);
        total_price = Integer.parseInt(txtvw_order_sum_price.getText().toString());
        order_total_price = total_price;

        for (int i = 0; i < CART_ITEMS.size(); i++) {
            currentListPosition = i;
            CartModal caral = CART_ITEMS.get(i);
            sum_product_price = Integer.parseInt(caral.getSum_price());
            order_total_price = order_total_price + sum_product_price;
            String check = String.valueOf(order_total_price);
            txtvw_order_sum_price.setText(check);
        }
    }

//    public void delProdFromCart(View view) {
//        id_product_cart_row = (TextView) findViewById(R.id.id_product_cart_row);
//        int iiiddd = Integer.parseInt(id_product_cart_row.getText().toString());
//        Toast.makeText(getApplicationContext(), iiiddd + "Message Deleted", Toast.LENGTH_SHORT).show();
//
//    }

    public void clickMenu(View view) {
        openDrawer(var_drawer_layout);
    }

    public static void openDrawer(DrawerLayout var_drawer_layout) {
        var_drawer_layout.openDrawer(GravityCompat.START);
    }

    public void clickLogo(View view) {
        closeDrawer(var_drawer_layout);
    }

    public static void closeDrawer(DrawerLayout var_drawer_layout) {
        if (var_drawer_layout.isDrawerOpen(GravityCompat.START)) {
            var_drawer_layout.closeDrawer(GravityCompat.START);
        }
    }

    public void clickHome(View view) {

        redirectActivity(this, drawer_layout.class);
    }

    public void clickHistory(View view) {
        redirectActivity(this, History.class);
    }



    public void clickProfile(View view) {
        redirectActivity(this, Profile.class);
    }

    public void gotoCart(View view) {
        recreate();
    }


    public void clickComplaints(View view) {
        redirectActivity(this, Complaints.class);
    }

    public void clickHireServices(View view) {
        redirectActivity(this, HireServices.class);
    }

    public void clickPayBills(View view) {
        redirectActivity(this, PayBills.class);
    }

    public void clickReserve(View view) {
        redirectActivity(this, Reserve.class);
    }

    public void clickShop(View view) {
        redirectActivity(this, Shop.class);
    }


    public void clickLogout(View view) {
        logout(this);
    }

    public static void logout(final Activity activity) {
        AlertDialog.Builder builder = new AlertDialog.Builder(activity);
        builder.setTitle("LOGOUT");
        builder.setMessage("Yes to logout...No to stay in...");
        builder.setPositiveButton("YES", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                activity.finishAffinity();
                System.exit(0);
            }
        });
        builder.setNegativeButton("NO", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        });
        builder.show();

    }


    public static void redirectActivity(Activity activity, Class aClass) {
        Intent intent = new Intent(activity, aClass);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        activity.startActivity(intent);

    }

    @Override
    protected void onPause() {
        super.onPause();
        closeDrawer(var_drawer_layout);
    }

    //=================================================================================
    public void checkOut(View view) {


        order_dest_address = (EditText) findViewById(R.id.order_dest_address);
        dest_address = order_dest_address.getText().toString();
//        Toast.makeText(getApplicationContext(), "-----------------" + dest_address + "-----" + stringOid + "------------", Toast.LENGTH_LONG).show();


        if (dest_address.isEmpty()) {

            Toast.makeText(getApplicationContext(), "Must enter delivery address!", Toast.LENGTH_SHORT).show();
        } else {
            uid = logged_in_user_id;
            random = (int) (Math.random() * 100000 + 100);
            oid = random;


            for (int i = 0; i < CART_ITEMS.size(); i++) {
                currentListPosition = i;
                CartModal cartModal = CART_ITEMS.get(i);
                pid = cartModal.getProduct_id();
                pnm = cartModal.getProduct_name();
                pprc = cartModal.getProduct_price();
                pqty = cartModal.getProduct_quantity();
                spprc = cartModal.getSum_price();


                stringOid = String.valueOf(oid);
                ostt = "pending";
                date = new SimpleDateFormat("yyyy-MM-dd hh:mm:ss", Locale.getDefault()).format(new Date());


                RequestQueue queue2 = Volley.newRequestQueue(this);
                StringRequest request2 = new StringRequest(Request.Method.POST, Constants.URL, new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        if (response.equals("added")) {
                            Toast.makeText(Cart.this, "Order Placed", Toast.LENGTH_SHORT).show();
                        } else {
                            Toast.makeText(Cart.this, "Failed! " + response, Toast.LENGTH_SHORT).show();
                        }
                    }
                }, new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Toast.makeText(getApplicationContext(), "Internet connection error", Toast.LENGTH_SHORT).show();
                    }
                }) {

                    protected Map<String, String> getParams() {
                        Map<String, String> params = new HashMap<String, String>();
                        params.put("function", "addOrder");
                        params.put("product_id", pid);
                        params.put("product_name", pnm);
                        params.put("product_price", pprc);
                        params.put("product_quantity", pqty);
                        params.put("product_sum_price", spprc);
                        params.put("order_status", ostt);
                        params.put("ord_id", stringOid);
                        params.put("user_id", uid);
                        params.put("ord_date_time", date);
                        params.put("ord_del_add", dest_address);
                        return params;
                    }
                };
                queue2.add(request2);


            }
            CART_ITEMS.clear();
            txtvw_order_sum_price.setText("0");
            order_dest_address.setText("");
        }


    }

    @Override
    public void delete(int position) {
        CART_ITEMS.remove(position);
        cart_main_adapter.notifyDataSetChanged();
        order_total_price=0;
        for (int i = 0; i < CART_ITEMS.size(); i++) {
         //   currentListPosition = i;
            CartModal caral = CART_ITEMS.get(i);
            sum_product_price = Integer.parseInt(caral.getSum_price());
            order_total_price = order_total_price + sum_product_price;
            String check = String.valueOf(order_total_price);
            txtvw_order_sum_price.setText(check);
        }
    }
}