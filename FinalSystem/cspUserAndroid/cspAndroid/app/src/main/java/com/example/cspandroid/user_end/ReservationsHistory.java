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
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.constraintlayout.widget.ConstraintLayout;
import androidx.core.view.GravityCompat;
import androidx.drawerlayout.widget.DrawerLayout;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cspandroid.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import static com.example.cspandroid.user_end.Constants.URL;
import static com.example.cspandroid.user_end.Constants.logged_in_user_id;


public class ReservationsHistory extends AppCompatActivity {


    private DrawerLayout var_drawer_layout;
    private Button btn_fetch_service;
    private Button btn_back_service_history;
    private LinearLayout upper_boundary_service_history, lower_boundary_service_history, toChangeColour_ll_ser_history;
    private TextView txtvw_info_spinner, serv_hist_serv_name, serv_hist_serv_req_time, serv_hist_serv_req_date, serv_hist_serv_loc, serv_hist_serv_desc, serv_hist_serv_status, serv_hist_serv_ID;
    private ImageView iv_info_fetch_details;
    private ConstraintLayout service_history_cons_L;


    private Spinner spinner_s_h;
    private List<String> spinnerList_s_h;
    private ArrayAdapter adapter_s_h;

    private int total, totalPrice, qty, prc;
    private String serv_date, serv_time, serv_loc, serv_desc, serv_status, serv_unq_id, serv_name;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reservations_history);
        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_reservations_history);

        btn_fetch_service = (Button) findViewById(R.id.btn_fetch_service);
        btn_back_service_history = (Button) findViewById(R.id.btn_back_service_history);
        upper_boundary_service_history = (LinearLayout) findViewById(R.id.upper_boundary_service_history);
        lower_boundary_service_history = (LinearLayout) findViewById(R.id.lower_boundary_service_history);
        spinner_s_h = (Spinner) findViewById(R.id.spinner_service_history);
        txtvw_info_spinner = (TextView) findViewById(R.id.txtvw_info_spinner);
        iv_info_fetch_details = (ImageView) findViewById(R.id.iv_info_fetch_details);
        service_history_cons_L = (ConstraintLayout) findViewById(R.id.service_history_cons_L);

        serv_hist_serv_name = (TextView) findViewById(R.id.serv_hist_serv_name);
        serv_hist_serv_req_time = (TextView) findViewById(R.id.serv_hist_serv_req_time);
        serv_hist_serv_req_date = (TextView) findViewById(R.id.serv_hist_serv_req_date);
        serv_hist_serv_loc = (TextView) findViewById(R.id.serv_hist_serv_loc);
        serv_hist_serv_desc = (TextView) findViewById(R.id.serv_hist_serv_desc);
        serv_hist_serv_status = (TextView) findViewById(R.id.serv_hist_serv_status);
        serv_hist_serv_ID = (TextView) findViewById(R.id.serv_hist_serv_ID);


        spinnerList_s_h = new ArrayList<>();
        adapter_s_h = new ArrayAdapter(this, android.R.layout.simple_list_item_1, spinnerList_s_h);
        spinner_s_h.setAdapter(adapter_s_h);

        getServicesList();


    }

    public void getServicesList() {
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
                            String s_name = object.getString("n_m_e");
                            String unq_ser_id = object.getString("unq_s_id");
                            String combo = unq_ser_id + " --- " + s_name;
                            spinnerList_s_h.add(combo);
                            adapter_s_h.notifyDataSetChanged();

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
                params.put("function", "getHiredServicesList");
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

        btn_back_service_history.setVisibility(View.VISIBLE);
        upper_boundary_service_history.setVisibility(View.VISIBLE);
        lower_boundary_service_history.setVisibility(View.VISIBLE);
        service_history_cons_L.setVisibility(View.VISIBLE);

        spinner_s_h.setVisibility(View.INVISIBLE);
        btn_fetch_service.setVisibility(View.INVISIBLE);
        txtvw_info_spinner.setVisibility(View.INVISIBLE);
        iv_info_fetch_details.setVisibility(View.INVISIBLE);


        String test=  spinner_s_h.getSelectedItem().toString();
        String[] array_from_string = test.split(" ");
        serv_hist_serv_name.setText(array_from_string[2]);


        getServiceDetails();

    }

    public void backToAllServices(View view) {

        btn_back_service_history.setVisibility(View.INVISIBLE);
        upper_boundary_service_history.setVisibility(View.INVISIBLE);
        lower_boundary_service_history.setVisibility(View.INVISIBLE);
        service_history_cons_L.setVisibility(View.INVISIBLE);

        iv_info_fetch_details.setVisibility(View.VISIBLE);
        spinner_s_h.setVisibility(View.VISIBLE);
        btn_fetch_service.setVisibility(View.VISIBLE);


    }

    public void getServiceDetails() {
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
                            object = array.getJSONObject(i);
                            serv_unq_id = object.getString("to_unq_serv_ID");

                            serv_date = object.getString("to_Date");
                            serv_time = object.getString("to_Time");
                            serv_loc = object.getString("to_location");
                            serv_desc = object.getString("to_desc");
                            serv_status = object.getString("to_status");


                            serv_hist_serv_req_time.setText(serv_time);
                            serv_hist_serv_req_date.setText(serv_date);
                            serv_hist_serv_loc.setText(serv_loc);
                            serv_hist_serv_desc.setText(serv_desc);
                            serv_hist_serv_status.setText(serv_status);
                            serv_hist_serv_ID.setText(serv_unq_id);

                        }


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
                params.put("function", "getServiceDetails");
                params.put("service_id_name", spinner_s_h.getSelectedItem().toString());
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