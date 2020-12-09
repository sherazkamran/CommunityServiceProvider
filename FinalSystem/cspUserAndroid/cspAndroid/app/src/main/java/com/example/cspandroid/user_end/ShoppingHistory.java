package com.example.cspandroid.user_end;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.GridView;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cspandroid.R;
import com.example.cspandroid.user_end.adapters.ShopHistoryAdapter;
import com.example.cspandroid.user_end.modals.HistoryShopModal;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import static com.example.cspandroid.user_end.Constants.URL;
import static com.example.cspandroid.user_end.Constants.logged_in_user_id;


public class ShoppingHistory extends AppCompatActivity {


    private Spinner spinner_shop_history;

    private DrawerLayout var_drawer_layout;
    private Button btn_fetch_order;
    private Button btn_back_shop_history;
    private GridView grid_shop_history;
    private LinearLayout cart_grid_ll, upper_boundary;
    private TextView history_order_status, order_total_price, order_date, txtvw_info_spinner;
    private ImageView iv_info_fetch_details;



    Spinner spinner;
    List<String> spinnerList;
    ArrayAdapter adapter;

    List<HistoryShopModal> ShopHistoryList;
    String orderId = "";
    ShopHistoryAdapter historyAdapter;

    private int total, totalPrice, qty, prc;
    private String totalOrderPrice, date, status;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_shopping_history);
        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_shopping_history);


        spinner = (Spinner) findViewById(R.id.spinner_shop_history);


        txtvw_info_spinner = (TextView) findViewById(R.id.txtvw_info_spinner);
        btn_fetch_order = (Button) findViewById(R.id.btn_fetch_order);
        btn_back_shop_history = (Button) findViewById(R.id.btn_back_shop_history);
        grid_shop_history = (GridView) findViewById(R.id.grid_shop_history);
        cart_grid_ll = (LinearLayout) findViewById(R.id.cart_grid_ll);
        upper_boundary = (LinearLayout) findViewById(R.id.upper_boundary);
        history_order_status = (TextView) findViewById(R.id.history_order_status);
        order_total_price = (TextView) findViewById(R.id.order_total_price);
        order_date = (TextView) findViewById(R.id.order_date);
        iv_info_fetch_details = (ImageView) findViewById(R.id.iv_info_fetch_details);


        spinnerList = new ArrayList<>();
        adapter = new ArrayAdapter(this, android.R.layout.simple_list_item_1, spinnerList);
        spinner.setAdapter(adapter);

        getList();


        ShopHistoryList = new ArrayList<>();
        historyAdapter = new ShopHistoryAdapter(this, ShopHistoryList);
        grid_shop_history.setAdapter(historyAdapter);


    }


    private void getList() {
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if (!response.equals("fail")) {
                    try {
                        JSONArray array = new JSONArray(response);
                        JSONObject object;
                        for (int i = 0; i < array.length(); i++) {
                            object = array.getJSONObject(i);
                            if (!orderId.equals(object.getString("order_id"))) {
                                orderId = object.getString("order_id");
                                String date = object.getString("date_time");
                                String combo = orderId + "   ---   " + date;
                                spinnerList.add(combo);
                                adapter.notifyDataSetChanged();
                            }
                        }
                    } catch (JSONException e) {
                        Log.e("data exception", e.toString());
                    }
                } else {
                    Toast.makeText(getApplicationContext(), "Failed to get. Try again later", Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Internet connection error" + error, Toast.LENGTH_SHORT).show();
            }
        }) {
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("function", "getOrderId");
                params.put("id", logged_in_user_id);
                return params;
            }
        };
        queue.add(request);
    }


    public void changeVisInfoSpinner(View view) {
        if (txtvw_info_spinner.getVisibility() == View.INVISIBLE || txtvw_info_spinner.getVisibility() == View.GONE) {
            txtvw_info_spinner.setVisibility(View.VISIBLE);

        } else if (txtvw_info_spinner.getVisibility() == View.VISIBLE) {
            txtvw_info_spinner.setVisibility(View.INVISIBLE);
        }
    }


    public void fetchCompleteDetails(View view) {

        btn_back_shop_history.setVisibility(View.VISIBLE);
        grid_shop_history.setVisibility(View.VISIBLE);
        cart_grid_ll.setVisibility(View.VISIBLE);
        upper_boundary.setVisibility(View.VISIBLE);
        spinner_shop_history = findViewById(R.id.spinner_shop_history);
        spinner_shop_history.setVisibility(View.INVISIBLE);
        btn_fetch_order.setVisibility(View.INVISIBLE);
        txtvw_info_spinner.setVisibility(View.INVISIBLE);
        iv_info_fetch_details.setVisibility(View.INVISIBLE);
        getOrderItems();

//        totalOrderPrice = String.valueOf(total);
//
//        history_order_status.setText(status);
//        order_total_price.setText(totalOrderPrice);
//        order_date.setText(date);


    }

    public void backToAllOrders(View view) {

        btn_back_shop_history.setVisibility(View.INVISIBLE);
        grid_shop_history.setVisibility(View.INVISIBLE);
        cart_grid_ll.setVisibility(View.INVISIBLE);
        upper_boundary.setVisibility(View.INVISIBLE);
        iv_info_fetch_details.setVisibility(View.VISIBLE);
        spinner_shop_history = findViewById(R.id.spinner_shop_history);
        spinner_shop_history.setVisibility(View.VISIBLE);
        btn_fetch_order.setVisibility(View.VISIBLE);

        history_order_status.setText("");
        order_total_price.setText("");
        order_date.setText("");

        ShopHistoryList.clear();

    }

    public void getOrderItems() {
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                total = 0;
                if (!response.equals("failed")) {
                    try {
                        JSONArray array = new JSONArray(response);
                        JSONObject object;
                        for (int i = 0; i < array.length(); i++) {
                            prc = 0;

                            object = array.getJSONObject(i);
                            HistoryShopModal modal = new HistoryShopModal();
                            prc = Integer.parseInt(object.getString("product_sum"));
                            total = total + prc;
                            date = object.getString("date_time");
                            status = object.getString("order_status");
                            modal.setOrderId(object.getString("order_id"));
                            modal.setOrder_item_name(object.getString("product_name"));
                            modal.setOrder_item_price(object.getString("product_price"));
                            modal.setOrder_item_quantity(object.getString("product_qty"));
                            modal.setOrder_item_sum_price(object.getString("product_sum"));


                            ShopHistoryList.add(modal);
                            historyAdapter.notifyDataSetChanged();

                        }
                        totalOrderPrice = String.valueOf(total);

                        history_order_status.setText(status);
                        order_total_price.setText(totalOrderPrice);
                        order_date.setText(date);
                    } catch (JSONException e) {
                        Log.e("data exception", e.toString());
                    }
                } else {
                    Toast.makeText(getApplicationContext(), "Failed", Toast.LENGTH_LONG).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "error" + error, Toast.LENGTH_SHORT).show();
            }
        }) {
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<String, String>();
                params.put("function", "getOrderItems");
                params.put("order_and_time", spinner.getSelectedItem().toString());
                return params;
            }
        };
        queue.add(request);
    }

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
        redirectActivity(this, Cart.class);
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


}