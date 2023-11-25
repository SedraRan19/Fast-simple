<?php

namespace App\Helpers;

use Crypt;
use Exception;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use App\Models\Vehicle;
use App\Models\Setting;
use Auth;

class GoogleCalendarHelper
{
    function __construct()
    {
        $this->vehicleModel = new Vehicle();
        $this->settingModel = new Setting();
    }

    public function insertToCalendar($data, $client, $setting)
    {
        try {
            $vehicle = $this->vehicleModel->getVehiclesById($data['vehicle_id'] ?? 0);
            $service = new Google_Service_Calendar($client);
            $description = "Event Description" . PHP_EOL . PHP_EOL;
            $description .= "Customer-Name  : " . $data['customer'] . PHP_EOL;
            // $description .= "Customer-Phone : " . $data['customer-phone'] . PHP_EOL . PHP_EOL;
            $description .= "   From : " . $data['src-address'] . PHP_EOL;
            $description .= "   To  : " . $data['dst-address'] . PHP_EOL . PHP_EOL;
            $description .= "Date : " . $data['date'] . PHP_EOL . PHP_EOL;
            $description .= "Passenger (" . $data['passenger_count'] . ")" . PHP_EOL;
            $description .= "  - Name  : " . $data['passenger_name'] . PHP_EOL;
            $description .= "  - Phone : " . $data['passenger_number'] . PHP_EOL . PHP_EOL;
            $description .= "Price : $";
            if ($data['payment-type'] == 'calculated') {
                $description .= $data['price'] . PHP_EOL . PHP_EOL;
            } else {
                $description .= $data['price'] . PHP_EOL . PHP_EOL;
            }

            if (isset($vehicle->id)) {
                $description .= "Vehicle : " . $vehicle->make . ' ' . $vehicle->model . ' ' . $vehicle->license_plate . PHP_EOL . PHP_EOL;
            }

           // $description .= "Permanent note feature : " . PHP_EOL;
            //$description .= $data['description'] . PHP_EOL . PHP_EOL;

            if ($data['is_checked_disclaimer'] == '1') {
                $description .= "Disclaimer : " . PHP_EOL;
                $description .= $setting->disclaimer_policy ?? '';
            }

            $setting = $this->settingModel->getSetting(Auth::user()->id);
            if(empty($setting->timezone)){$timezone = 'America/Chicago';}else{$timezone = $setting->timezone;}
            date_default_timezone_set($timezone);
            $end_date = date("c", strtotime($data['end_date']));
            $start_date = date("c", strtotime($data['start_date']));

            $event = new Google_Service_Calendar_Event(array(
                'summary' => $data['passenger_name'],
                'location' => $data['src-address'],
                'description' => $description,
                'start' => array(
                    'dateTime' => $start_date,
                    'timeZone' => $timezone,
                ),
                'end' => array(
                    'dateTime' => $end_date,
                    'timeZone' => $timezone,
                ),
                'reminders' => array(
                    'useDefault' => FALSE,
                    'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'popup', 'minutes' => 24 * 60),
                        array('method' => 'email', 'minutes' => 60),
                        array('method' => 'popup', 'minutes' => 60),
                    ),
                ),
            ));

            $calendarId = 'primary';
            $event = $service->events->insert($calendarId, $event);
            return $event;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


    // update event to calendar

    public function updateToCalendar($data, $client, $setting)
    {
        try {
            $vehicle = $this->vehicleModel->getVehiclesById($data['vehicle_id']);
            $service = new Google_Service_Calendar($client);
            $description = "Event Description" . PHP_EOL . PHP_EOL;
            $description .= "Customer-Name  : " . $data['customer'] . PHP_EOL;
            // $description .= "Customer-Phone : " . $data['customer-phone'] . PHP_EOL . PHP_EOL;
            $description .= "   From : " . $data['src-address'] . PHP_EOL;
            $description .= "   To  : " . $data['dst-address'] . PHP_EOL . PHP_EOL;
            $description .= "Date : " . $data['date'] . PHP_EOL . PHP_EOL;
            $description .= "Passenger (" . $data['passenger_count'] . ")" . PHP_EOL;
            $description .= "  - Name  : " . $data['passenger_name'] . PHP_EOL;
            $description .= "  - Phone : " . $data['passenger_number'] . PHP_EOL . PHP_EOL;
            $description .= "Price : $";
            if ($data['payment-type'] == 'calculated') {
                $description .= $data['price'] . PHP_EOL . PHP_EOL;
            } else {
                $description .= $data['price'] . PHP_EOL . PHP_EOL;
            }

            if (isset($vehicle->id)) {
                $description .= "Vehicle : " . $vehicle->make . ' ' . $vehicle->model . ' ' . $vehicle->license_plate . PHP_EOL . PHP_EOL;
            }
           // $description .= "Permanent note feature : " . PHP_EOL;
            //$description .= $data['description'] . PHP_EOL . PHP_EOL;

            if ($data['is_checked_disclaimer'] == '1') {
                $description .= "Disclaimer : " . PHP_EOL;
                $description .= $setting->disclaimer_policy ?? '';
            }

            $setting = $this->settingModel->getSetting(Auth::user()->id);
            if(empty($setting->timezone)){$timezone = 'America/Chicago';}else{$timezone = $setting->timezone;}

            //$timezone = date_default_timezone_get($timezone_name);
            date_default_timezone_set($timezone);
            $end_date = date("c", strtotime($data['end_date']));
            $start_date = date("c", strtotime($data['start_date']));

            $event = new Google_Service_Calendar_Event(array(
                'summary' => $data['passenger_name'],
                'location' => $data['src-address'],
                'description' => $description,
                'start' => array(
                    'dateTime' => $start_date,
                    'timeZone' => $timezone,
                ),
                'end' => array(
                    'dateTime' => $end_date,
                    'timeZone' => $timezone,
                ),
                'reminders' => array(
                    'useDefault' => FALSE,
                    'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'popup', 'minutes' => 24 * 60),
                        array('method' => 'email', 'minutes' => 60),
                        array('method' => 'popup', 'minutes' => 60),
                    ),
                ),
            ));

            $calendarId = 'primary';
            if(isset($data['calendar_id']) && $data['calendar_id'] !=''){
                $service->events->delete($calendarId, $data['calendar_id']);
            }
            $event = $service->events->insert($calendarId, $event);
            return $event;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
