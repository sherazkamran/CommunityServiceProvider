package com.example.cspandroid.user_end;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.util.Log;
import android.view.View;
import android.os.Bundle;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cspandroid.R;


import androidx.annotation.Nullable;
import androidx.core.view.GravityCompat;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;

import static com.example.cspandroid.user_end.Constants.URL;
import static com.example.cspandroid.user_end.Constants.logged_in_user_id;

//------------------------------------------------------------------------------------------------------------------------------------
public class HireServices extends AppCompatActivity implements AdapterView.OnItemSelectedListener {

    private Spinner spinner_hire_services;

    private DrawerLayout var_drawer_layout;
    private EditText edt_txt_address_hire_professional, edt_txt_problem_description;
    private String add_hire_prof, prob_desc, service_type, s_status, h_date, h_time, stringUnique_ID, stringUserID, checkServiceName, checkS_availability;
    private int userID, unique_ID;


    Spinner spinnerHire;
    List<String> spinnerListHire;
    ArrayAdapter adapterHire;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_hire_services);
        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_hire_services);


        spinner_hire_services = (Spinner) findViewById(R.id.spinner_hire_services);

        spinnerHire = (Spinner) findViewById(R.id.spinner_hire_services);
//        ArrayAdapter<CharSequence> spin_adapter = ArrayAdapter.createFromResource(this, R.array.professional_services, android.R.layout.simple_spinner_item);
//        spin_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
//        spinner_hire_services.setAdapter(spin_adapter);
//        spinner_hire_services.setOnItemSelectedListener(this);


        spinnerListHire = new ArrayList<>();
        adapterHire = new ArrayAdapter(this, android.R.layout.simple_list_item_1, spinnerListHire);
        spinnerHire.setAdapter(adapterHire);
        getservices();

    }

    private void getservices() {


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
                            String service = object.getString("name");
                            spinnerListHire.add(service);
                            adapterHire.notifyDataSetChanged();

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
                params.put("function", "getServices");
                params.put("id", logged_in_user_id);
                return params;
            }
        };
        queue.add(request);


    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }

    //    =================================================================================================================================
    public void hireProfService(View view) {
        edt_txt_address_hire_professional = (EditText) findViewById(R.id.edt_txt_address_hire_professional);
        edt_txt_problem_description = (EditText) findViewById(R.id.edt_txt_problem_description);

        userID = Integer.parseInt(logged_in_user_id);
        stringUserID = String.valueOf(userID);
        add_hire_prof = edt_txt_address_hire_professional.getText().toString();
        prob_desc = edt_txt_problem_description.getText().toString();
        service_type = spinner_hire_services.getSelectedItem().toString();

        if (add_hire_prof.isEmpty()) {
            Toast.makeText(getApplicationContext(), "Provide address!", Toast.LENGTH_LONG).show();
        } else if (prob_desc.isEmpty()) {
            Toast.makeText(getApplicationContext(), "Provide brief description!", Toast.LENGTH_LONG).show();
        } else if (service_type.isEmpty()) {
            Toast.makeText(getApplicationContext(), "Select service type!", Toast.LENGTH_LONG).show();
        } else {

            unique_ID = (int) (Math.random() * 100000 + 100);
            stringUnique_ID = String.valueOf(unique_ID);
            s_status = "Pending";
            h_date = new SimpleDateFormat("yyyy-MM-dd", Locale.getDefault()).format(new Date());
            h_time = new SimpleDateFormat("hh:mm:ss", Locale.getDefault()).format(new Date());


            RequestQueue queue2 = Volley.newRequestQueue(this);
            StringRequest request2 = new StringRequest(Request.Method.POST, Constants.URL, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    if (response.equals("added")) {
                        Toast.makeText(HireServices.this, "Service Confirmed", Toast.LENGTH_SHORT).show();
                        edt_txt_address_hire_professional.setText("");
                        edt_txt_problem_description.setText("");
                    } else {
                        Toast.makeText(HireServices.this, "Cannot Confirm Service! Try again later! " + response, Toast.LENGTH_SHORT).show();
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
                    params.put("function", "placeServiceRequest");
                    params.put("str_u_id", stringUserID);
                    params.put("str_address", add_hire_prof);
                    params.put("str_desc", prob_desc);
                    params.put("str_srv_type", service_type);
                    params.put("str_unique_id", stringUnique_ID);
                    params.put("str_status", s_status);
                    params.put("str_h_date", h_date);
                    params.put("str_h_time", h_time);
                    return params;

                }
            };
            queue2.add(request2);
        }


        //Toast.makeText(getApplicationContext(), "-----" + unique_ID + "-----" + h_date + "-----" + h_time + "-----", Toast.LENGTH_LONG).show();

    }

    //==========================================================================================================
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


    public void gotoCart(View view) {
        redirectActivity(this, Cart.class);
    }

    public void clickProfile(View view) {
        redirectActivity(this, Profile.class);
    }


    public void clickComplaints(View view) {
        redirectActivity(this, Complaints.class);
    }

    public void clickHireServices(View view) {
        recreate();
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