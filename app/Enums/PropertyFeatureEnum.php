<?php

namespace App\Enums;

enum PropertyFeatureEnum
{

    const MAIDS_ROOM = "Maids Room";
    const STUDY = "Study";
    const CENTRAL_AC_HEATING = "Central A/C & Heating";
    const CONCIERGE_SERVICE = "Concierge Service";
    const BALCONY = "Balcony";
    const PRIVATE_GARDEN = "Private Garden";
    const PRIVATE_POOL = "Private Pool";
    const PRIVATE_GYM = "Private Gym";
    const PRIVATE_JACUZZI = "Private Jacuzzi";
    const SHARED_POOL = "Shared Pool";
    const SHARED_SPA = "Shared Spa";
    const SHARED_GYM = "Shared Gym";
    const SECURITY = "Security";
    const MAID_SERVICE = "Maid Service";
    const COVERED_PARKING = "Covered Parking";
    const BUILT_IN_WARDROBES = "Built-in Wardrobes";
    const WALK_IN_CLOSET = "Walk-in Closet";
    const BUILT_IN_KITCHEN_APPLIANCES = "Built-in Kitchen Appliances";
    const VIEW_OF_WATER = "View of Water";
    const VIEW_OF_LANDMARK = "View of Landmark";
    const PETS_ALLOWED = "Pets Allowed";
    const DOUBLE_GLAZED_WINDOWS = "Double Glazed Windows";
    const DAY_CARE_CENTER = "Day Care Center";
    const ELECTRICITY_BACKUP = "Electricity Backup";
    const FIRST_AID_MEDICAL_CENTER = "First Aid Medical Center";
    const SERVICE_ELEVATORS = "Service Elevators";
    const PRAYER_ROOM = "Prayer Room";
    const LAUNDRY_ROOM = "Laundry Room";
    const BROADBAND_INTERNET = "Broadband Internet";
    const SATELLITE_CABLE_TV = "Satellite / Cable TV";
    const BUSINESS_CENTER = "Business Center";
    const INTERCOM = "Intercom";
    const ATM_FACILITY = "ATM Facility";
    const KIDS_PLAY_AREA = "Kids Play Area";
    const RECEPTION_WAITING_ROOM = "Reception / Waiting Room";
    const MAINTENANCE_STAFF = "Maintenance Staff";
    const CCTV_SECURITY = "CCTV Security";
    const CAFETERIA_OR_CANTEEN = "Cafeteria or Canteen";
    const SHARED_KITCHEN = "Shared Kitchen";
    const FACILITIES_FOR_DISABLED = "Facilities for Disabled";
    const STORAGE_AREAS = "Storage Areas";
    const CLEANING_SERVICES = "Cleaning Services";
    const BARBEQUE_AREA = "Barbeque Area";
    const LOBBY_IN_BUILDING = "Lobby in Building";
    const WASTE_DISPOSAL = "Waste Disposal";
    const CONFERENCE_ROOM = 'Conference Room';
    const AVAILABLE_FURNISHED = 'Available Furnished';
    const AVAILABLE_NETWORKED = 'Available Networked';
    const DINING_IN_BUILDING = 'Dining In Building';
    const RETAIL_IN_BUILDING = 'Retail In Building';

    public static function values(): array
    {
        return [
            self::MAIDS_ROOM,
            self::STUDY,
            self::CENTRAL_AC_HEATING,
            self::CONCIERGE_SERVICE,
            self::BALCONY,
            self::PRIVATE_GARDEN,
            self::PRIVATE_POOL,
            self::PRIVATE_GYM,
            self::PRIVATE_JACUZZI,
            self::SHARED_POOL,
            self::SHARED_SPA,
            self::SHARED_GYM,
            self::SECURITY,
            self::MAID_SERVICE,
            self::COVERED_PARKING,
            self::BUILT_IN_WARDROBES,
            self::WALK_IN_CLOSET,
            self::BUILT_IN_KITCHEN_APPLIANCES,
            self::VIEW_OF_WATER,
            self::VIEW_OF_LANDMARK,
            self::PETS_ALLOWED,
            self::DOUBLE_GLAZED_WINDOWS,
            self::DAY_CARE_CENTER,
            self::ELECTRICITY_BACKUP,
            self::FIRST_AID_MEDICAL_CENTER,
            self::SERVICE_ELEVATORS,
            self::PRAYER_ROOM,
            self::LAUNDRY_ROOM,
            self::BROADBAND_INTERNET,
            self::SATELLITE_CABLE_TV,
            self::BUSINESS_CENTER,
            self::INTERCOM,
            self::ATM_FACILITY,
            self::KIDS_PLAY_AREA,
            self::RECEPTION_WAITING_ROOM,
            self::MAINTENANCE_STAFF,
            self::CCTV_SECURITY,
            self::CAFETERIA_OR_CANTEEN,
            self::SHARED_KITCHEN,
            self::FACILITIES_FOR_DISABLED,
            self::STORAGE_AREAS,
            self::CLEANING_SERVICES,
            self::BARBEQUE_AREA,
            self::LOBBY_IN_BUILDING,
            self::WASTE_DISPOSAL,
            self::CONFERENCE_ROOM,
            self::AVAILABLE_FURNISHED,
            self::AVAILABLE_NETWORKED,
            self::DINING_IN_BUILDING,
            self::RETAIL_IN_BUILDING,
        ];
    }

}


