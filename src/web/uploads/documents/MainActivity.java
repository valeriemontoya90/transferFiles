package com.example.testapp01;

import android.support.v7.app.ActionBarActivity;
import android.annotation.TargetApi;
import android.content.Context;
import android.location.LocationManager;
import android.os.Build;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;


@TargetApi(Build.VERSION_CODES.GINGERBREAD)
public class MainActivity extends ActionBarActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.layout_main_activity);
        LocationManager myLocationManager = (LocationManager) this.getSystemService(Context.LOCATION_SERVICE);
        MyLocationListener mylocationlistener = new MyLocationListener(getApplicationContext());
        myLocationManager.requestSingleUpdate(LocationManager.GPS_PROVIDER, mylocationlistener,null);
    }
}
