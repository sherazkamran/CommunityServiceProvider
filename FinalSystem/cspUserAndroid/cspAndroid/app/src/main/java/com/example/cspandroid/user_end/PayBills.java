package com.example.cspandroid.user_end;

import androidx.appcompat.app.AppCompatActivity;
import androidx.drawerlayout.widget.DrawerLayout;

import android.net.Uri;
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
import com.squareup.picasso.Picasso;

import androidx.annotation.Nullable;
import androidx.core.view.GravityCompat;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

import static com.example.cspandroid.user_end.Constants.URL;
import static com.example.cspandroid.user_end.Constants.logged_in_user_id;
import static com.example.cspandroid.user_end.Constants.outer_path_to_images;


public class PayBills extends AppCompatActivity {


    private DrawerLayout var_drawer_layout;
    private EditText edt_txt_bill_id;
    private TextView txt_vw_bill_month, abcdefghijk;
    private Button btn_fetch_bill_details, btn_pay_bill_pay_bills;
    private ImageView iv_bill_img;
    private RadioGroup rg_bill_status;
    private RadioButton rb_paid, rb_not_paid;
    private String b_id, bill_id, bill_month, bill_status, bill_image, PAY_NOW_ID;
    private LinearLayout bill_month_status;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pay_bills);
        var_drawer_layout = (DrawerLayout) findViewById(R.id.activity_pay_bills);

        txt_vw_bill_month = (TextView) findViewById(R.id.txt_vw_bill_month);
        edt_txt_bill_id = (EditText) findViewById(R.id.edt_txt_bill_id);
        btn_fetch_bill_details = (Button) findViewById(R.id.btn_fetch_bill_details);
        iv_bill_img = (ImageView) findViewById(R.id.iv_bill_img);
        rg_bill_status = (RadioGroup) findViewById(R.id.rg_bill_status);
        btn_pay_bill_pay_bills = (Button) findViewById(R.id.btn_pay_bill_pay_bills);
        rb_paid = (RadioButton) findViewById(R.id.rb_paid);
        rb_not_paid = (RadioButton) findViewById(R.id.rb_not_paid);
        bill_month_status = (LinearLayout) findViewById(R.id.bill_month_status);

    }

    public void fetchBillDetails(View view) {
        b_id = edt_txt_bill_id.getText().toString();
        if (!b_id.isEmpty()) {
            fetchDetails();
        } else {
            Toast.makeText(this, "Provide Bill ID!", Toast.LENGTH_LONG).show();
        }
    }

    public void fetchDetails() {
        bill_id = edt_txt_bill_id.getText().toString();
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest request = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                if (!response.equals("failed")) {
                    edt_txt_bill_id.setVisibility(View.INVISIBLE);
                    btn_fetch_bill_details.setVisibility(View.INVISIBLE);

                    btn_pay_bill_pay_bills.setVisibility(View.VISIBLE);
                    iv_bill_img.setVisibility(View.VISIBLE);
                    bill_month_status.setVisibility(View.VISIBLE);
                    try {
                        JSONArray array = new JSONArray(response);
                        JSONObject object;
                        for (int i = 0; i < array.length(); i++) {
                            object = array.getJSONObject(i);
                            bill_image = object.getString("image");
                            bill_status = object.getString("status");
                            bill_month = object.getString("month");
                            PAY_NOW_ID = object.getString("bid");


                            if (bill_status.equals("Paid")) {
                                rb_paid.setChecked(true);
                            } else if (bill_status.equals("Unpaid")) {
                                rb_not_paid.setChecked(true);
                            }
                            txt_vw_bill_month.setText(bill_month);

                            String path = outer_path_to_images + bill_image;
                            Uri actualPath = Uri.parse(path);
                            Picasso.get().load(actualPath).into(iv_bill_img);

                        }
                    } catch (JSONException e) {
                        Log.e("data exception", e.toString());
                    }
                } else if (response.equals("failed")) {
                    Toast.makeText(getApplicationContext(), "No ***" + response + "***", Toast.LENGTH_LONG).show();
                } else {
                    Toast.makeText(getApplicationContext(), "Process Failed! Try again later", Toast.LENGTH_LONG).show();
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
                params.put("function", "getBillDetails");
                params.put("billID", bill_id);
                params.put("userID", logged_in_user_id);
                return params;
            }
        };
        queue.add(request);
    }

    public void overToPayNowScreen(View view) {
        edt_txt_bill_id.setVisibility(View.VISIBLE);
        btn_fetch_bill_details.setVisibility(View.VISIBLE);

        btn_pay_bill_pay_bills.setVisibility(View.INVISIBLE);
        iv_bill_img.setVisibility(View.INVISIBLE);
        bill_month_status.setVisibility(View.INVISIBLE);

        Intent intent = new Intent(getBaseContext(), PayNow.class);
        intent.putExtra("bill_id_from_payBils", bill_id);
        startActivity(intent);

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
        redirectActivity(this, HireServices.class);
    }

    public void clickPayBills(View view) {
        recreate();
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

    public void clickReserve(View view) {
        redirectActivity(this, Reserve.class);
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