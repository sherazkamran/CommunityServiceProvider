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

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

import static com.example.cspandroid.user_end.Constants.logged_in_user_id;


public class Complaints extends AppCompatActivity implements AdapterView.OnItemSelectedListener {


    private DrawerLayout var_drawer_layout;
    private Spinner spinner_complaint_category;
    private EditText edt_txt_complaint_description, edt_txt_complaint_subject;
    private Button btn_submit_complaint;

    private String description, subject, type, status, stringUnique_ID, comp_date, comp_time;
    private int userID, unique_ID;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_complaints);
        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_complaints);

        spinner_complaint_category = (Spinner) findViewById(R.id.spinner_complaint_category);
        ArrayAdapter<CharSequence> spin_adapter = ArrayAdapter.createFromResource(this, R.array.complain_categories, android.R.layout.simple_spinner_item);
        spin_adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinner_complaint_category.setAdapter(spin_adapter);
        spinner_complaint_category.setOnItemSelectedListener(this);


        edt_txt_complaint_description = (EditText) findViewById(R.id.edt_txt_complaint_description);
        edt_txt_complaint_subject = (EditText) findViewById(R.id.edt_txt_complaint_subject);
        btn_submit_complaint = (Button) findViewById(R.id.btn_submit_complaint);

    }

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {

    }

    @Override
    public void onNothingSelected(AdapterView<?> parent) {

    }

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public void submitComp(View view) {
        description = edt_txt_complaint_description.getText().toString();
        subject = edt_txt_complaint_subject.getText().toString();
        type = spinner_complaint_category.getSelectedItem().toString();
        status = "Pending";

        comp_date = new SimpleDateFormat("yyyy-MM-dd", Locale.getDefault()).format(new Date());
        comp_time = new SimpleDateFormat("hh:mm:ss", Locale.getDefault()).format(new Date());

        unique_ID = (int) (Math.random() * 100000 + 100);
        userID = Integer.parseInt(logged_in_user_id);

        if (!description.isEmpty()) {
            if (!subject.isEmpty()) {
                if (!type.isEmpty()) {

                    RequestQueue queue2 = Volley.newRequestQueue(this);
                    StringRequest request2 = new StringRequest(Request.Method.POST, Constants.URL, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            if (response.equals("added")) {
                                Toast.makeText(Complaints.this, "Complaint accepted!", Toast.LENGTH_SHORT).show();
                                edt_txt_complaint_subject.setText("");
                                edt_txt_complaint_description.setText("");

                            } else {
                                Toast.makeText(Complaints.this, "Cannot Accept Request! Try again later! " + response, Toast.LENGTH_SHORT).show();
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
                            params.put("function", "placeComplaintRequest");
                            params.put("str_type", type);
                            params.put("str_subject", subject);
                            params.put("str_desc", description);
                            params.put("str_status", status);
                            params.put("str_u_id", String.valueOf(userID));
                            params.put("str_unq_id", String.valueOf(unique_ID));
                            params.put("str_c_time", comp_time);
                            params.put("str_c_date", comp_date);
                            return params;

                        }
                    };
                    queue2.add(request2);


                } else {
                    Toast.makeText(getApplicationContext(), "Select type of complaint.", Toast.LENGTH_LONG).show();
                }

            } else {
                Toast.makeText(getApplicationContext(), "Provide  brief subject of complaint.", Toast.LENGTH_LONG).show();
            }

        } else {

            Toast.makeText(getApplicationContext(), "Provide  brief description of complaint.", Toast.LENGTH_LONG).show();
        }


    }

    //-------------------------------------------------------------------------------------------------------------
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
        recreate();
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