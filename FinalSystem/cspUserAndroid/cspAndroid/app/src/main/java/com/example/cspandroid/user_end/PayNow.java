package com.example.cspandroid.user_end;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.TextView;
import android.widget.Toast;

import com.example.cspandroid.R;
import com.squareup.timessquare.CalendarPickerView;

import java.util.Calendar;
import java.util.Date;

public class PayNow extends AppCompatActivity {

    private String pay_bills_bill_id;
    private TextView pay_bill_intented_bill_ID;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pay_now);
        pay_bills_bill_id = getIntent().getStringExtra("bill_id_from_payBils");
        pay_bill_intented_bill_ID = (TextView) findViewById(R.id.pay_bill_intented_bill_ID);
        pay_bill_intented_bill_ID.setText(pay_bills_bill_id);

        dateChecking();
    }

    public void dateChecking() {
        Date today = new Date();
        Calendar nextYear = Calendar.getInstance();
        nextYear.add(Calendar.DATE, 2);
        CalendarPickerView datePicker = findViewById(R.id.exp_date_pay_now);
        datePicker.init(today, nextYear.getTime()).inMode(CalendarPickerView.SelectionMode.RANGE).withSelectedDate(today);

        datePicker.setOnDateSelectedListener(new CalendarPickerView.OnDateSelectedListener() {
            @Override
            public void onDateSelected(Date date) {
                //String selectedDate = DateFormat.getDateInstance(DateFormat.FULL).format(date);
                Calendar calSelected = Calendar.getInstance();
                calSelected.setTime(date);
                String selectedDate = String.valueOf( calSelected.get(Calendar.DAY_OF_MONTH)
                        + "* " + (calSelected.get(Calendar.HOUR_OF_DAY) + 1)
                        + "* " + calSelected.get(Calendar.YEAR));
                Toast.makeText(PayNow.this, selectedDate, Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onDateUnselected(Date date) {
            }
        });
    }

}