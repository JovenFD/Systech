<?php
include '../../initialize.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    $Inspection_ID     = $_POST['inspection_id'];
    $engine_no         = $_POST['Engine'];
    $chasis_no         = $_POST['Chassis'];
    $plate_no          = $_POST['plate-upload'];
    $mv                = $_POST['mvfile-upload'];
    $fueltype          = isset($_POST['opacity_k']) ? 1 : 0;
    $HCidle            = isset($_POST['emission_hc']) ? 1 : 0;
    $COidle            = isset($_POST['emission_co']) ? 1 : 0;
    $k                 = $_POST['opacity_k'];
    $category          = null;
    $pmvic_center_data = $_POST['pmvic_name'];
    $inspector_name    = $_POST['inspector_name'];
    $transaction_no    = $_POST['ref_no'];



    // print_r('<pre>');
    // print_r($_POST);
    // print_r('</pre>');
    // die();


    $mode_data = "";
    $mode_data = 1;

    $purpose_data = "";
    $purpose_data = 'FOR REGISTRATION';

    $itp_code_data = "";
    $itp_code_data = "Sys";


    #region pmvic json format
    if ($HCidle == "" ||  $HCidle == NULL) {
        $HCidle = 1;
    }

    if ($COidle == "" ||  $COidle == NULL) {
        $COidle = 0.1;
    }
    $CO2idle = "";
    if ($CO2idle == "" ||  $CO2idle == NULL) {
        $CO2idle = 1;
    }
    $O2idle = "";
    if ($O2idle == "" ||  $O2idle == NULL) {
        $O2idle = 1;
    }
    $NOidle = "";
    if ($NOidle == "" ||  $NOidle == NULL) {
        $NOidle = 1;
    }
    $LAMBDAidle = "";
    if ($LAMBDAidle == "" ||  $LAMBDAidle == NULL) {
        $LAMBDAidle = 1;
    }
    $RPMidle = "";
    if ($RPMidle == "" ||  $RPMidle == NULL) {
        $RPMidle = 1;
    }


    $RPMfast = "";
    if ($RPMfast == "" ||  $RPMfast == NULL) {
        $RPMfast = 1;
    }


    $HCfast = "";
    if ($HCfast == "" ||  $HCfast == NULL) {
        $HCfast = 1;
    }
    $COfast = "";
    if ($COfast == "" ||  $COfast == NULL) {
        $COfast = 1;
    }
    $CO2fast = "";
    if ($CO2fast == "" ||  $CO2fast == NULL) {
        $CO2fast = 1;
    }
    $O2fast = "";
    if ($O2fast == "" ||  $O2fast == NULL) {
        $O2fast = 1;
    }
    $NOfast = "";
    if ($NOfast == "" ||  $NOfast == NULL) {
        $NOfast = 1;
    }
    $LAMBDAfast = "";
    if ($LAMBDAfast == "" ||  $LAMBDAfast == NULL) {
        $LAMBDAfast = 1;
    }
    $opacity = "";
    if ($opacity == "" ||  $opacity == NULL) {
        $opacity = 1;
    }
    $Highlefthorizontal = "";
    if ($Highlefthorizontal == "" ||  $Highlefthorizontal == NULL) {
        $Highlefthorizontal = 1;
    }
    $Highrighthorizontal = "";
    if ($Highrighthorizontal == "" ||  $Highrighthorizontal == NULL) {
        $Highrighthorizontal = 1;
    }
    $Lowlefthorizontal = "";
    if ($Lowlefthorizontal == "" ||  $Lowlefthorizontal == NULL) {
        $Lowlefthorizontal = 1;
    }
    $lowrighthorizontal = "";
    if ($lowrighthorizontal == "" ||  $lowrighthorizontal == NULL) {
        $lowrighthorizontal = 1;
    }
    $Highleftvertical = "";
    if ($Highleftvertical == "" ||  $Highleftvertical == NULL) {
        $Highleftvertical = 1;
    }
    $Highrightvertical = "";
    if ($Highrightvertical == "" ||   $Highrightvertical == NULL) {
        $Highrightvertical = 1;
    }
    $Lowleftvertical = "";
    if ($Lowleftvertical == "" ||   $Lowleftvertical == NULL) {
        $Lowleftvertical = 1;
    }
    $lowrightvertical = "";
    if ($lowrightvertical == "" ||   $lowrightvertical == NULL) {
        $lowrightvertical = 1;
    }
    $Highleftintensity = "";
    if ($Highleftintensity == "" ||   $Highleftintensity == NULL) {
        $Highleftintensity = 1;
    }
    $Highrightintensity = "";
    if ($Highrightintensity == "" ||  $Highrightintensity == NULL) {
        $Highrightintensity = 1;
    }
    $Lowleftintensity = "";
    if ($Lowleftintensity == "" ||  $Lowleftintensity == NULL) {
        $Lowleftintensity = 1;
    }
    $lowrightintensity = "";
    if ($lowrightintensity == "" ||  $lowrightintensity == NULL) {
        $lowrightintensity = 1;
    }
    $Highleftpitchangle = "";
    if ($Highleftpitchangle == "" ||  $Highleftpitchangle == NULL) {
        $Highleftpitchangle = 1;
    }
    $Highrightpitchangle = "";
    if ($Highrightpitchangle == "" ||  $Highrightpitchangle == NULL) {
        $Highrightpitchangle = 1;
    }
    $Lowleftpitchangle = "";
    if ($Lowleftpitchangle == "" ||  $Lowleftpitchangle == NULL) {
        $Lowleftpitchangle = 1;
    }
    $lowrightpitchangle = "";
    if ($lowrightpitchangle == "" ||  $lowrightpitchangle == NULL) {
        $lowrightpitchangle = 1;
    }
    $value1 = "";
    if ($value1 == "" ||  $value1 == NULL) {
        $value1 = 1;
    }
    $value2 = "";
    if ($value2 == "" ||  $value2 == NULL) {
        $value2 = 1;
    }
    $value3 = "";
    if ($value3 == "" ||  $value3 == NULL) {
        $value3 = 1;
    }
    $value4 = "";
    if ($value4 == "" ||  $value4 == NULL) {
        $value4 = 1;
    }
    $axleleftweight1 = "";
    if ($axleleftweight1 == "" ||  $axleleftweight1 == NULL) {
        $axleleftweight1 = 1;
    }
    $axlerightweight1 = "";
    if ($axlerightweight1 == "" ||  $axlerightweight1 == NULL) {
        $axlerightweight1 = 1;
    }
    $axleleftfrequency1 = "";
    if ($axleleftfrequency1 == "" ||  $axleleftfrequency1 == NULL) {
        $axleleftfrequency1 = 1;
    }
    $axlerightfrequency1 = "";
    if ($axlerightfrequency1 == "" ||  $axlerightfrequency1 == NULL) {
        $axlerightfrequency1 = 1;
    }
    $axleleftefficieny1 = "";
    if ($axleleftefficieny1 == "" ||  $axleleftefficieny1 == NULL) {
        $axleleftefficieny1 = 1;
    }
    $axlerightefficieny1 = "";
    if ($axlerightefficieny1 == "" ||  $axlerightefficieny1 == NULL) {
        $axlerightefficieny1 = 1;
    }
    $axleaxleweight1 = "";
    if ($axleaxleweight1 == "" ||  $axleaxleweight1 == NULL) {
        $axleaxleweight1 = 1;
    }
    $axleleftweight2 = "";
    if ($axleleftweight2 == "" ||  $axleleftweight2 == NULL) {
        $axleleftweight2 = 1;
    }
    $axlerightweight2 = "";
    if ($axlerightweight2 == "" ||  $axlerightweight2 == NULL) {
        $axlerightweight2 = 1;
    }
    $axleleftfrequency2 = "";
    if ($axleleftfrequency2 == "" ||  $axleleftfrequency2 == NULL) {
        $axleleftfrequency2 = 1;
    }
    $axlerightfrequency2 = "";
    if ($axlerightfrequency2 == "" ||  $axlerightfrequency2 == NULL) {
        $axlerightfrequency2 = 1;
    }
    $axleleftefficieny2 = "";
    if ($axleleftefficieny2 == "" ||  $axleleftefficieny2 == NULL) {
        $axleleftefficieny2 = 1;
    }
    $axlerightefficieny2 = "";
    if ($axlerightefficieny2 == "" ||  $axlerightefficieny2 == NULL) {
        $axlerightefficieny2 = 1;
    }
    $axleaxleweight2 = "";
    if ($axleaxleweight2 == "" ||  $axleaxleweight2 == NULL) {
        $axleaxleweight2 = 1;
    }
    $axleleftweight3 = "";
    if ($axleleftweight3 == "" ||  $axleleftweight3 == NULL) {
        $axleleftweight3 = 1;
    }
    $axlerightweight3 = "";
    if ($axlerightweight3 == "" ||  $axlerightweight3 == NULL) {
        $axlerightweight3 = 1;
    }
    $axleleftfrequency3 = "";
    if ($axleleftfrequency3 == "" ||  $axleleftfrequency3 == NULL) {
        $axleleftfrequency3 = 1;
    }
    $axlerightfrequency3 = "";
    if ($axlerightfrequency3 == "" ||  $axlerightfrequency3 == NULL) {
        $axlerightfrequency3 = 1;
    }
    $axleleftefficieny3 = "";
    if ($axleleftefficieny3 == "" ||  $axleleftefficieny3 == NULL) {
        $axleleftefficieny3 = 1;
    }
    $axlerightefficieny3 = "";
    if ($axlerightefficieny3 == "" ||  $axlerightefficieny3 == NULL) {
        $axlerightefficieny3 = 1;
    }
    $axleaxleweight3 = "";
    if ($axleaxleweight3 == "" ||  $axleaxleweight3 == NULL) {
        $axleaxleweight3 = 1;
    }
    $axleleftweight4 = "";
    if ($axleleftweight4 == "" ||  $axleleftweight4 == NULL) {
        $axleleftweight4 = 1;
    }
    $axlerightweight4 = "";
    if ($axlerightweight4 == "" ||  $axlerightweight4 == NULL) {
        $axlerightweight4 = 1;
    }
    $axleleftfrequency4 = "";
    if ($axleleftfrequency4 == "" ||  $axleleftfrequency4 == NULL) {
        $axleleftfrequency4 = 1;
    }
    $axlerightfrequency4 = "";
    if ($axlerightfrequency4 == "" ||  $axlerightfrequency4 == NULL) {
        $axlerightfrequency4 = 1;
    }
    $axleleftefficieny4 = "";
    if ($axleleftefficieny4 == "" ||  $axleleftefficieny4 == NULL) {
        $axleleftefficieny4 = 1;
    }
    $axlerightefficieny4 = "";
    if ($axlerightefficieny4 == "" ||  $axlerightefficieny4 == NULL) {
        $axlerightefficieny4 = 1;
    }
    $axleaxleweight4 = "";
    if ($axleaxleweight4 == "" ||  $axleaxleweight4 == NULL) {
        $axleaxleweight4 = 1;
    }
    $Service1WeightLeft = "";
    if ($Service1WeightLeft == "" ||  $Service1WeightLeft == NULL) {
        $Service1WeightLeft = 1;
    }
    $Service1WeightRight = "";
    if ($Service1WeightRight == "" ||  $Service1WeightRight == NULL) {
        $Service1WeightRight = 1;
    }
    $Service1WeightTotal = "";
    if ($Service1WeightTotal == "" ||  $Service1WeightTotal == NULL) {
        $Service1WeightTotal = 1;
    }
    $Service1ForceLeft = "";
    if ($Service1ForceLeft == "" ||  $Service1ForceLeft == NULL) {
        $Service1ForceLeft = 1;
    }
    $Service1ForceRight = "";
    if ($Service1ForceRight == "" ||  $Service1ForceRight == NULL) {
        $Service1ForceRight = 1;
    }
    $Service1ForceDifference = "";
    if ($Service1ForceDifference == "" ||  $Service1ForceDifference == NULL) {
        $Service1ForceDifference = 1;
    }
    $Service1RollingResistanceLeft = "";
    if ($Service1RollingResistanceLeft == "" ||  $Service1RollingResistanceLeft == NULL) {
        $Service1RollingResistanceLeft = 1;
    }
    $Service1RollingResistanceRight = "";
    if ($Service1RollingResistanceRight == "" ||  $Service1RollingResistanceRight == NULL) {
        $Service1RollingResistanceRight = 1;
    }
    $Service1RollingOvalisationLeft = "";
    if ($Service1RollingOvalisationLeft == "" ||  $Service1RollingOvalisationLeft == NULL) {
        $Service1RollingOvalisationLeft = 1;
    }
    $Service1RollingOvalisationRight = "";
    if ($Service1RollingOvalisationRight == "" ||  $Service1RollingOvalisationRight == NULL) {
        $Service1RollingOvalisationRight = 1;
    }
    $Service2WeightLeft = "";
    if ($Service2WeightLeft == "" ||  $Service2WeightLeft == NULL) {
        $Service2WeightLeft = 1;
    }
    $Service2WeightRight = "";
    if ($Service2WeightRight == "" ||  $Service2WeightRight == NULL) {
        $Service2WeightRight = 1;
    }
    $Service2WeightTotal = "";
    if ($Service2WeightTotal == "" ||  $Service2WeightTotal == NULL) {
        $Service2WeightTotal = 1;
    }
    $Service2ForceLeft = "";
    if ($Service2ForceLeft == "" ||  $Service2ForceLeft == NULL) {
        $Service2ForceLeft = 1;
    }
    $Service2ForceRight = "";
    if ($Service2ForceRight == "" ||  $Service2ForceRight == NULL) {
        $Service2ForceRight = 1;
    }
    $Service2ForceDifference = "";
    if ($Service2ForceDifference == "" ||  $Service2ForceDifference == NULL) {
        $Service2ForceDifference = 1;
    }
    $Service2RollingResistanceLeft = "";
    if ($Service2RollingResistanceLeft == "" ||  $Service2RollingResistanceLeft == NULL) {
        $Service2RollingResistanceLeft = 1;
    }
    $Service2RollingResistanceRight = "";
    if ($Service2RollingResistanceRight == "" ||  $Service2RollingResistanceRight == NULL) {
        $Service2RollingResistanceRight = 1;
    }
    $Service2RollingOvalisationLeft = "";
    if ($Service2RollingOvalisationLeft == "" ||  $Service2RollingOvalisationLeft == NULL) {
        $Service2RollingOvalisationLeft = 1;
    }
    $Service2RollingOvalisationRight = "";
    if ($Service2RollingOvalisationRight == "" ||  $Service2RollingOvalisationRight == NULL) {
        $Service2RollingOvalisationRight = 1;
    }
    $ParkingWeightLeft = "";
    if ($ParkingWeightLeft == "" ||  $ParkingWeightLeft == NULL) {
        $ParkingWeightLeft = 1;
    }
    $ParkingWeightRight = "";
    if ($ParkingWeightRight == "" ||  $ParkingWeightRight == NULL) {
        $ParkingWeightRight = 1;
    }
    $ParkingWeightTotal = "";
    if ($ParkingWeightTotal == "" ||  $ParkingWeightTotal == NULL) {
        $ParkingWeightTotal = 1;
    }
    $ParkingForceLeft = "";
    if ($ParkingForceLeft == "" ||  $ParkingForceLeft == NULL) {
        $ParkingForceLeft = 1;
    }
    $ParkingForceRight = "";
    if ($ParkingForceRight == "" ||  $ParkingForceRight == NULL) {
        $ParkingForceRight = 1;
    }
    $ParkingForceDifference = "";
    if ($ParkingForceDifference == "" ||  $ParkingForceDifference == NULL) {
        $ParkingForceDifference = 1;
    }
    $ParkingRollingResistanceLeft = "";
    if ($ParkingRollingResistanceLeft == "" ||  $ParkingRollingResistanceLeft == NULL) {
        $ParkingRollingResistanceLeft = 1;
    }
    $ParkingRollingResistanceRight = "";
    if ($ParkingRollingResistanceRight == "" ||  $ParkingRollingResistanceRight == NULL) {
        $ParkingRollingResistanceRight = 1;
    }
    $ParkingRollingOvalisationLeft = "";
    if ($ParkingRollingOvalisationLeft == "" ||  $ParkingRollingOvalisationLeft == NULL) {
        $ParkingRollingOvalisationLeft = 1;
    }
    $ParkingRollingOvalisationRight = "";
    if ($ParkingRollingOvalisationRight == "" ||  $ParkingRollingOvalisationRight == NULL) {
        $ParkingRollingOvalisationRight = 1;
    }
    $ItemID1 = "";
    if ($ItemID1 == "" ||  $ItemID1 == NULL) {
        $ItemID1 = 1;
    }
    $ItemID2 = "";
    if ($ItemID2 == "" ||  $ItemID2 == NULL) {
        $ItemID2 = 2;
    }
    $ItemID3 = "";
    if ($ItemID3 == "" ||  $ItemID3 == NULL) {
        $ItemID3 = 3;
    }
    $ItemID4 = "";
    if ($ItemID4 == "" ||  $ItemID4 == NULL) {
        $ItemID4 = 4;
    }
    $ItemID5 = "";
    if ($ItemID5 == "" ||  $ItemID5 == NULL) {
        $ItemID5 = 5;
    }
    $ItemID6 = "";
    if ($ItemID6 == "" ||  $ItemID6 == NULL) {
        $ItemID6 = 6;
    }
    $ItemID7 = "";
    if ($ItemID7 == "" ||  $ItemID7 == NULL) {
        $ItemID7 = 7;
    }
    $ItemID8 = "";
    if ($ItemID8 == "" ||  $ItemID8 == NULL) {
        $ItemID8 = 8;
    }
    $ItemID9 = "";
    if ($ItemID9 == "" ||  $ItemID9 == NULL) {
        $ItemID9 = 9;
    }
    $ItemID11 = "";
    if ($ItemID11 == "" ||  $ItemID11 == NULL) {
        $ItemID11 = 11;
    }
    $ItemID11 = "";
    if ($ItemID11 == "" ||  $ItemID11 == NULL) {
        $ItemID11 = 11;
    }
    $ItemID12 = "";
    if ($ItemID12 == "" ||  $ItemID12 == NULL) {
        $ItemID12 = 12;
    }
    $ItemID13 = "";
    if ($ItemID13 == "" ||  $ItemID13 == NULL) {
        $ItemID13 = 13;
    }
    $ItemID14 = "";
    if ($ItemID14 == "" ||  $ItemID14 == NULL) {
        $ItemID14 = 14;
    }
    $ItemID15 = "";
    if ($ItemID15 == "" ||  $ItemID15 == NULL) {
        $ItemID15 = 15;
    }
    $ItemID16 = "";
    if ($ItemID16 == "" ||  $ItemID16 == NULL) {
        $ItemID16 = 16;
    }
    $ItemID17 = "";
    if ($ItemID17 == "" ||  $ItemID17 == NULL) {
        $ItemID17 = 17;
    }
    $ItemID18 = "";
    if ($ItemID18 == "" ||  $ItemID18 == NULL) {
        $ItemID18 = 18;
    }
    $ItemID19 = "";
    if ($ItemID19 == "" ||  $ItemID19 == NULL) {
        $ItemID19 = 19;
    }
    $ItemID21 = "";
    if ($ItemID21 == "" ||  $ItemID21 == NULL) {
        $ItemID21 = 21;
    }
    $ItemID21 = "";
    if ($ItemID21 == "" ||  $ItemID21 == NULL) {
        $ItemID21 = 21;
    }
    $ItemID22 = "";
    if ($ItemID22 == "" ||  $ItemID22 == NULL) {
        $ItemID22 = 22;
    }
    $ItemID23 = "";
    if ($ItemID23 == "" ||  $ItemID23 == NULL) {
        $ItemID23 = 23;
    }
    $ItemID24 = "";
    if ($ItemID24 == "" ||  $ItemID24 == NULL) {
        $ItemID24 = 24;
    }
    $ItemID25 = "";
    if ($ItemID25 == "" ||  $ItemID25 == NULL) {
        $ItemID25 = 25;
    }
    $ItemID26 = "";
    if ($ItemID26 == "" ||  $ItemID26 == NULL) {
        $ItemID26 = 26;
    }
    $ItemID27 = "";
    if ($ItemID27 == "" ||  $ItemID27 == NULL) {
        $ItemID27 = 27;
    }
    $ItemID28 = "";
    if ($ItemID28 == "" ||  $ItemID28 == NULL) {
        $ItemID28 = 28;
    }
    $ItemID29 = "";
    if ($ItemID29 == "" ||  $ItemID29 == NULL) {
        $ItemID29 = 29;
    }
    $ItemID31 = "";
    if ($ItemID31 == "" ||  $ItemID31 == NULL) {
        $ItemID31 = 31;
    }
    $ItemID31 = "";
    if ($ItemID31 == "" ||  $ItemID31 == NULL) {
        $ItemID31 = 31;
    }
    $ItemID32 = "";
    if ($ItemID32 == "" ||  $ItemID32 == NULL) {
        $ItemID32 = 32;
    }
    $ItemID33 = "";
    if ($ItemID33 == "" ||  $ItemID33 == NULL) {
        $ItemID33 = 33;
    }
    $ItemID34 = "";
    if ($ItemID34 == "" ||  $ItemID34 == NULL) {
        $ItemID34 = 34;
    }
    $ItemID35 = "";
    if ($ItemID35 == "" ||  $ItemID35 == NULL) {
        $ItemID35 = 35;
    }
    $ItemID36 = "";
    if ($ItemID36 == "" ||  $ItemID36 == NULL) {
        $ItemID36 = 36;
    }
    $ItemID37 = "";
    if ($ItemID37 == "" ||  $ItemID37 == NULL) {
        $ItemID37 = 37;
    }
    $ItemID38 = "";
    if ($ItemID38 == "" ||  $ItemID38 == NULL) {
        $ItemID38 = 38;
    }
    $ItemID39 = "";
    if ($ItemID39 == "" ||  $ItemID39 == NULL) {
        $ItemID39 = 39;
    }
    $ItemID41 = "";
    if ($ItemID41 == "" ||  $ItemID41 == NULL) {
        $ItemID41 = 41;
    }
    $ItemID41 = "";
    if ($ItemID41 == "" ||  $ItemID41 == NULL) {
        $ItemID41 = 41;
    }
    $ItemID42 = "";
    if ($ItemID42 == "" ||  $ItemID42 == NULL) {
        $ItemID42 = 42;
    }
    $ItemID43 = "";
    if ($ItemID43 == "" ||  $ItemID43 == NULL) {
        $ItemID43 = 43;
    }
    $ItemID44 = "";
    if ($ItemID44 == "" ||  $ItemID44 == NULL) {
        $ItemID44 = 44;
    }
    $ItemID45 = "";
    if ($ItemID45 == "" ||  $ItemID45 == NULL) {
        $ItemID45 = 45;
    }
    $ItemID46 = "";
    if ($ItemID46 == "" ||  $ItemID46 == NULL) {
        $ItemID46 = 46;
    }
    $ItemID47 = "";
    if ($ItemID47 == "" ||  $ItemID47 == NULL) {
        $ItemID47 = 47;
    }
    $ItemID48 = "";
    if ($ItemID48 == "" ||  $ItemID48 == NULL) {
        $ItemID48 = 48;
    }
    $ItemID49 = "";
    if ($ItemID49 == "" ||  $ItemID49 == NULL) {
        $ItemID49 = 49;
    }
    $ItemID51 = "";
    if ($ItemID51 == "" ||  $ItemID51 == NULL) {
        $ItemID51 = 51;
    }
    $ItemID51 = "";
    if ($ItemID51 == "" ||  $ItemID51 == NULL) {
        $ItemID51 = 51;
    }
    $ItemID52 = "";
    if ($ItemID52 == "" ||  $ItemID52 == NULL) {
        $ItemID52 = 52;
    }
    $ItemID53 = "";
    if ($ItemID53 == "" ||  $ItemID53 == NULL) {
        $ItemID53 = 53;
    }
    $ItemID54 = "";
    if ($ItemID54 == "" ||  $ItemID54 == NULL) {
        $ItemID54 = 54;
    }
    $ItemID55 = "";
    if ($ItemID55 == "" ||  $ItemID55 == NULL) {
        $ItemID55 = 55;
    }
    $ItemID56 = "";
    if ($ItemID56 == "" ||  $ItemID56 == NULL) {
        $ItemID56 = 56;
    }
    $ItemID57 = "";
    if ($ItemID57 == "" ||  $ItemID57 == NULL) {
        $ItemID57 = 57;
    }
    $ItemID58 = "";
    if ($ItemID58 == "" ||  $ItemID58 == NULL) {
        $ItemID58 = 58;
    }
    $ItemID59 = "";
    if ($ItemID59 == "" ||  $ItemID59 == NULL) {
        $ItemID59 = 59;
    }
    $ItemID61 = "";
    if ($ItemID61 == "" ||  $ItemID61 == NULL) {
        $ItemID61 = 61;
    }
    $ItemID61 = "";
    if ($ItemID61 == "" ||  $ItemID61 == NULL) {
        $ItemID61 = 61;
    }
    $ItemID62 = "";
    if ($ItemID62 == "" ||  $ItemID62 == NULL) {
        $ItemID62 = 62;
    }
    $ItemID63 = "";
    if ($ItemID63 == "" ||  $ItemID63 == NULL) {
        $ItemID63 = 63;
    }
    $ItemID64 = "";
    if ($ItemID64 == "" ||  $ItemID64 == NULL) {
        $ItemID64 = 64;
    }
    $ItemID65 = "";
    if ($ItemID65 == "" ||  $ItemID65 == NULL) {
        $ItemID65 = 65;
    }
    $Score1 = "";
    if ($Score1 == "" ||  $Score1 == NULL) {
        $Score1 = 1;
    }
    $Score2 = "";
    if ($Score2 == "" ||  $Score2 == NULL) {
        $Score2 = 1;
    }
    $Score3 = "";
    if ($Score3 == "" ||  $Score3 == NULL) {
        $Score3 = 1;
    }
    $Score4 = "";
    if ($Score4 == "" ||  $Score4 == NULL) {
        $Score4 = 1;
    }
    $Score5 = "";
    if ($Score5 == "" ||  $Score5 == NULL) {
        $Score5 = 1;
    }
    $Score6 = "";
    if ($Score6 == "" ||  $Score6 == NULL) {
        $Score6 = 1;
    }
    $Score7 = "";
    if ($Score7 == "" ||  $Score7 == NULL) {
        $Score7 = 1;
    }
    $Score8 = "";
    if ($Score8 == "" ||  $Score8 == NULL) {
        $Score8 = 1;
    }
    $Score9 = "";
    if ($Score9 == "" ||  $Score9 == NULL) {
        $Score9 = 1;
    }

    $Score10 = "";
    if ($Score10 == "" ||  $Score10 == NULL) {
        $Score10 = 1;
    }
    $Score11 = "";
    if ($Score11 == "" ||  $Score11 == NULL) {
        $Score11 = 1;
    }
    $Score12 = "";
    if ($Score12 == "" ||  $Score12 == NULL) {
        $Score12 = 1;
    }
    $Score13 = "";
    if ($Score13 == "" ||  $Score13 == NULL) {
        $Score13 = 1;
    }
    $Score14 = "";
    if ($Score14 == "" ||  $Score14 == NULL) {
        $Score14 = 1;
    }
    $Score15 = "";
    if ($Score15 == "" ||  $Score15 == NULL) {
        $Score15 = 1;
    }
    $Score16 = "";
    if ($Score16 == "" ||  $Score16 == NULL) {
        $Score16 = 1;
    }
    $Score17 = "";
    if ($Score17 == "" ||  $Score17 == NULL) {
        $Score17 = 1;
    }
    $Score18 = "";
    if ($Score18 == "" ||  $Score18 == NULL) {
        $Score18 = 1;
    }
    $Score19 = "";
    if ($Score19 == "" ||  $Score19 == NULL) {
        $Score19 = 1;
    }
    $Score20 = "";
    if ($Score20 == "" ||  $Score20 == NULL) {
        $Score20 = 1;
    }
    $Score21 = "";
    if ($Score21 == "" ||  $Score21 == NULL) {
        $Score21 = 1;
    }
    $Score22 = "";
    if ($Score22 == "" ||  $Score22 == NULL) {
        $Score22 = 1;
    }
    $Score23 = "";
    if ($Score23 == "" ||  $Score23 == NULL) {
        $Score23 = 1;
    }
    $Score24 = "";
    if ($Score24 == "" ||  $Score24 == NULL) {
        $Score24 = 1;
    }
    $Score25 = "";
    if ($Score25 == "" ||  $Score25 == NULL) {
        $Score25 = 1;
    }
    $Score26 = "";
    if ($Score26 == "" ||  $Score26 == NULL) {
        $Score26 = 1;
    }
    $Score27 = "";
    if ($Score27 == "" ||  $Score27 == NULL) {
        $Score27 = 1;
    }
    $Score28 = "";
    if ($Score28 == "" ||  $Score28 == NULL) {
        $Score28 = 1;
    }
    $Score29 = "";
    if ($Score29 == "" ||  $Score29 == NULL) {
        $Score29 = 1;
    }
    $Score30 = "";
    if ($Score30 == "" ||  $Score30 == NULL) {
        $Score30 = 1;
    }
    $Score31 = "";
    if ($Score31 == "" ||  $Score31 == NULL) {
        $Score31 = 1;
    }
    $Score32 = "";
    if ($Score32 == "" ||  $Score32 == NULL) {
        $Score32 = 1;
    }
    $Score33 = "";
    if ($Score33 == "" ||  $Score33 == NULL) {
        $Score33 = 1;
    }
    $Score34 = "";
    if ($Score34 == "" ||  $Score34 == NULL) {
        $Score34 = 1;
    }
    $Score35 = "";
    if ($Score35 == "" ||  $Score35 == NULL) {
        $Score35 = 1;
    }
    $Score36 = "";
    if ($Score36 == "" ||  $Score36 == NULL) {
        $Score36 = 1;
    }
    $Score37 = "";
    if ($Score37 == "" ||  $Score37 == NULL) {
        $Score37 = 1;
    }
    $Score38 = "";
    if ($Score38 == "" ||  $Score38 == NULL) {
        $Score38 = 1;
    }
    $Score39 = "";
    if ($Score39 == "" ||  $Score39 == NULL) {
        $Score40 = 1;
    }
    $Score41 = "";
    if ($Score40 == "" ||  $Score40 == NULL) {
        $Score40 = 1;
    }
    $Score41 = "";
    if ($Score41 == "" ||  $Score41 == NULL) {
        $Score41 = 1;
    }
    $Score42 = "";
    if ($Score42 == "" ||  $Score42 == NULL) {
        $Score42 = 1;
    }
    $Score43 = "";
    if ($Score43 == "" ||  $Score43 == NULL) {
        $Score43 = 1;
    }
    $Score44 = "";
    if ($Score44 == "" ||  $Score44 == NULL) {
        $Score44 = 1;
    }
    $Score45 = "";
    if ($Score45 == "" ||  $Score45 == NULL) {
        $Score45 = 1;
    }
    $Score46 = "";
    if ($Score46 == "" ||  $Score46 == NULL) {
        $Score46 = 1;
    }
    $Score47 = "";
    if ($Score47 == "" ||  $Score47 == NULL) {
        $Score47 = 1;
    }
    $Score48 = "";
    if ($Score48 == "" ||  $Score48 == NULL) {
        $Score48 = 1;
    }
    $Score49 = "";
    if ($Score49 == "" ||  $Score49 == NULL) {
        $Score49 = 1;
    }
    $Score50 = "";
    if ($Score50 == "" ||  $Score50 == NULL) {
        $Score50 = 1;
    }
    $Score51 = "";
    if ($Score51 == "" ||  $Score51 == NULL) {
        $Score51 = 1;
    }
    $Score52 = "";
    if ($Score52 == "" ||  $Score52 == NULL) {
        $Score52 = 1;
    }
    $Score53 = "";
    if ($Score53 == "" ||  $Score53 == NULL) {
        $Score53 = 1;
    }
    $Score54 = "";
    if ($Score54 == "" ||  $Score54 == NULL) {
        $Score54 = 1;
    }
    $Score55 = "";
    if ($Score55 == "" ||  $Score55 == NULL) {
        $Score55 = 1;
    }
    $Score56 = "";
    if ($Score56 == "" ||  $Score56 == NULL) {
        $Score56 = 1;
    }
    $Score57 = "";
    if ($Score57 == "" ||  $Score57 == NULL) {
        $Score57 = 1;
    }
    $Score58 = "";
    if ($Score58 == "" ||  $Score58 == NULL) {
        $Score58 = 1;
    }
    $Score59 = "";
    if ($Score59 == "" ||  $Score59 == NULL) {
        $Score59 = 1;
    }
    $Score60 = "";
    if ($Score60 == "" ||  $Score60 == NULL) {
        $Score60 = 1;
    }
    $Score61 = "";
    if ($Score61 == "" ||  $Score61 == NULL) {
        $Score61 = 1;
    }
    $Score62 = "";
    if ($Score62 == "" ||  $Score62 == NULL) {
        $Score62 = 1;
    }
    $Score63 = "";
    if ($Score63 == "" ||  $Score63 == NULL) {
        $Score63 = 1;
    }
    $Score64 = "";
    if ($Score64 == "" ||  $Score64 == NULL) {
        $Score64 = 1;
    }
    $Score65 = "";
    if ($Score65 == "" ||  $Score65 == NULL) {
        $Score65 = 1;
    }

    $pipe = '"Idle": {
                        "HC": ' . $HCidle . ',
                        "CO": ' . $COidle . ',
                        "CO2": ' . $CO2idle . ',
                        "O2": ' . $O2idle . ',
                        "NO": ' . $NOidle . ',
                        "Lambda": ' . $LAMBDAidle . ',
                        "Oil_Temperature": 0.0,
                        "RPM": ' . $RPMidle . '
                    },
                "Fast": {
                        "HC": ' . $HCfast . ',
                        "CO": ' . $COfast . ',
                        "CO2":' . $CO2fast . ',
                        "O2": ' . $O2fast . ',
                        "NO": ' . $NOfast . ',
                        "Lambda": ' . $LAMBDAfast . ',
                        "Oil_Temperature": 0.0,
                        "RPM": ' . $RPMfast . '
                        }';
    $pipe2 = '"Fast": {
        "HC": ' . $HCfast . ',
        "CO": ' . $COfast . ',
        "CO2":' . $CO2fast . ',
        "O2": ' . $O2fast . ',
        "NO": ' . $NOfast . ',
        "Lambda": ' . $LAMBDAfast . ',
        "Oil_Temperature": 0.0,
        "RPM": ' . $RPMfast . '
        }';

    //*******************************************************************************************************************///
    //**************************************************EMISSION CONTROL*****************************************************************///

    $temp_light_high = "";
    $temp_light_low = "";
    $light = "";

    //*******************************************************************************************************************///
    //**************************************************LIGHTS CONTROL*****************************************************************///
    //************HIGH BEAM************///
    $temp_light_high .= '
                            "Left_Vertical":  ' . round($Highleftvertical, 2) . ',
                            "Left_Horizontal": ' . round($Highlefthorizontal, 2) . ',
                            "Left_Intensity": ' . round($Highleftintensity, 2) . ',
                            "Left_Yaw_Angle": 0.0,
                            "Left_Pitch_Angle": ' . round($Highleftpitchangle, 2) . ',
                            "Left_Elevation": 0.0,
                            "Right_Vertical": ' . round($Highrightvertical, 2) . ',
                            "Right_Horizontal": ' . round($Highrighthorizontal, 2) . ',
                            "Right_Intensity": ' . round($Highrightintensity, 2) . ',
                            "Right_Yaw_Angle": 0.0,
                            "Right_Pitch_Angle": ' . round($Highrightpitchangle, 2) . ',
                            "Right_Elevation": 0.0,';

    //************LOW BEAM************///
    $temp_light_low .= '
                            "Left_Vertical":  ' . round($Lowleftvertical, 2) . ',
                            "Left_Horizontal": ' . round($Lowlefthorizontal, 2) . ',
                            "Left_Intensity": ' . round($Lowleftintensity, 2) . ',
                            "Left_Yaw_Angle": 0.0,
                            "Left_Pitch_Angle": ' . round($Lowleftpitchangle, 2) . ',
                            "Left_Elevation": 0.0,
                            "Right_Vertical": ' . round($lowrightvertical, 2) . ',
                            "Right_Horizontal": ' . round($lowrighthorizontal, 2) . ',
                            "Right_Intensity": ' . round($lowrightintensity, 2) . ',
                            "Right_Yaw_Angle": 0.0,
                            "Right_Pitch_Angle": ' . round($lowrightpitchangle, 2) . ',
                            "Right_Elevation": 0.0,';


    $light .= '"High_Beams": {';
    $light .= $temp_light_high;
    $light .= ' "Difference": 0.0
                                },';
    $light .= ' "Low_Beams": {';
    $light .= $temp_light_low;
    $light .= ' "Difference": 0.0
                                },';


    $suspension_row = "";
    $suspension_row .= '
                    {
                    "Left_Weight": ' . $axleleftweight1 . ',
                    "Left_Frequency": ' . $axleleftfrequency1 . ',
                    "Left_Efficiency": ' . $axleleftefficieny1 . ',
                    "Right_Weight": ' . $axlerightweight1 . ',
                    "Right_Frequency": ' . $axlerightfrequency1 . ',
                    "Right_Efficiency": ' . $axleleftweight1 . ',
                    "Axle_Weight": ' . $axlerightefficieny1 . ',
                    "Frequency_Difference": 0.0,
                    "Efficiency_Difference": 0.0
                },';

    $suspension_row .= '
                    {
                    "Left_Weight": ' . $axleleftweight2 . ',
                    "Left_Frequency": ' . $axleleftfrequency2 . ',
                    "Left_Efficiency": ' . $axleleftefficieny2 . ',
                    "Right_Weight": ' . $axlerightweight2 . ',
                    "Right_Frequency": ' . $axlerightfrequency2 . ',
                    "Right_Efficiency": ' . $axleleftweight2 . ',
                    "Axle_Weight": ' . $axlerightefficieny2 . ',
                    "Frequency_Difference": 0.0,
                    "Efficiency_Difference": 0.0
                }';

    $brake_axel1 = "";

    $brake_axel2 = "";
    $brake_axel1 = '"Service": {
                        "Weight_Left": ' . $Service1WeightLeft . ',
                        "Weight_Right": ' . $Service1WeightRight . ',
                        "Weight_Total": ' . $Service1WeightTotal . ',
                        "Force_Left":' . $Service1ForceLeft . ',
                        "Force_Right": ' . $Service1ForceRight . ',
                        "Force_Difference": ' . $Service1ForceDifference . ',
                        "Efficiency_Left":0.0,
                        "Efficiency_Right":0.0,
                        "Efficiency": 0.0,
                        "Rolling_Resistance_Left": ' . $Service1RollingResistanceLeft . ',
                        "Rolling_Resistance_Right": ' . $Service1RollingResistanceRight . ',
                        "Ovalisation_Left": ' . $Service1RollingOvalisationLeft . ',
                        "Ovalisation_Right": ' . $Service1RollingOvalisationRight . ',
                        "Pedal_Force": 0.0,
                        "Pressure": 0.0
                    },
                    "Parking": null';

    $brake_axel2 = '
                    "Service": {
                        "Weight_Left": ' . $Service2WeightLeft . ',
                        "Weight_Right": ' . $Service2WeightRight . ',
                        "Weight_Total": ' . $Service2WeightTotal . ',
                        "Force_Left": ' . $Service2ForceLeft . ',
                        "Force_Right": ' . $Service2ForceRight . ',
                        "Force_Difference": ' . $Service2ForceDifference . ',
                        "Efficiency_Left": 0.0,
                        "Efficiency_Right": 0.0,
                        "Efficiency": 0.0,
                        "Rolling_Resistance_Left": ' . $Service2RollingResistanceLeft . ',
                        "Rolling_Resistance_Right": ' . $Service2RollingResistanceRight . ',
                        "Ovalisation_Left": ' . $Service2RollingOvalisationLeft . ',
                        "Ovalisation_Right": ' . $Service2RollingOvalisationRight . ',
                        "Pedal_Force": 0.0,
                        "Pressure": 0.0
                    },';

    $brake_axel3 = "";
    $brake_axel3 = '"Parking": {
                        "Weight_Left": ' . $ParkingWeightLeft . ',
                        "Weight_Right": ' . $ParkingWeightRight . ',
                        "Weight_Total": ' . $ParkingWeightTotal . ',
                        "Force_Left": ' . $ParkingForceLeft . ',
                        "Force_Right": ' . $ParkingForceRight . ',
                        "Force_Difference": ' . $ParkingForceDifference . ',
                        "Efficiency_Left": 1.0,
                        "Efficiency_Right": 1.0,
                        "Efficiency": 1.0,
                        "Rolling_Resistance_Left": ' . $ParkingRollingResistanceLeft . ',
                        "Rolling_Resistance_Right": ' . $ParkingRollingResistanceRight . ',
                        "Ovalisation_Left": ' . $ParkingRollingOvalisationLeft . ',
                        "Ovalisation_Right": ' . $ParkingRollingOvalisationRight . ',
                        "Pedal_Force": 1.0,
                        "Pressure":1.0
                            }';

    $now = new DateTime();
    $datetime_start = $now->format('Y-m-d H:is');
    $datetime_end  = $now->format('Y-m-d H:is');

    $angle = null;
    if (empty($angle)  ||   $angle == null  ||   $angle == ""  ||   $angle === '') {
        $angle = 0;
    }


    $vehicle_information_data = '{
            "Mileage": 1,
            "Chassis": "' . $chasis_no . '",
            "Engine": "' . $engine_no . '",
            "MV_File_No": "' . $mv . '",
            "plate_no":"' . $plate_no . '"
        }';


    $maxval = "";
    $critlimit = "";

    if ($maxval == "") {
        $maxval = 0.0;
    }

    if ($critlimit == "") {
        $critlimit = 0.0;
    }

    $SoundVerdict = "";

    if ($SoundVerdict == "" || $SoundVerdict == NULL) {
        $SoundVerdict = 1;
    }
    $noise_data = "";

    $noise_data = '{
            "Status": null,
            "Pipe": [
                {
                    "DateTime_Start":"' . $datetime_start . '" ,
                    "DateTime_End":"' . $datetime_end . '",
                    "engine": {
                        "dbA":' . $maxval . ',
                        "dbA_limit":' . $critlimit . ',
                        "Verdict": 1
                    },
                    "exhaust": {
                        "dbA": 0.0,
                        "dbA_limit": -1.0,
                        "Verdict": 1
                    },
                    "horn": {
                        "dbA": 0.0,
                        "dbA_limit": -1.0,
                        "Verdict": ' . $SoundVerdict . '
                    }
                }
            ],
            "DateTime_Start":   "' . $datetime_start . '",
            "DateTime_End": "' . $datetime_end . '",
            "Verdict": 1
        }';

    // if ($fuel == "Gas") {
    //     $fueltype = 0;
    // } else {
    //     $fueltype = 1;
    // }


    // if ($fueltype == "" || $fueltype == NULL) {
    //     $fueltype = 1;
    // }
    $emission_data = "";
    $emission_data = '{
            "Status": {
                "Status": 1,
                "Remarks": "PASSED"
            },
            "DateTime_Start":  "' . $datetime_start . '",
            "DateTime_End": "' . $datetime_end . '",
            "Fuel_obj": [
                {
                    "Fuel": ' . $fueltype . ',
                    "Pipe": [
                        {
                            ' . $pipe . '
                        },
                        {
                            ' . $pipe2 . '
                        }
                    ]
                }
            ],
                "Result_HC": "' . $HCidle . '",
                "Result_CO": "' . $COidle . '",
                "Verdict": 1
            }';

    $opacity = $k;
    if ($opacity == "" ||  $opacity == NULL) {
        $opacity = 1;
    }
    $opacity_data = "";

    $opacity_data = $opacity;

    $opacity_data = '{
            "DateTime_Start": "' . $datetime_start . '",
            "DateTime_End": "' . $datetime_end . '",
            "Pipe": [
                {
                    "DateTime_Start": null,
                    "DateTime_End": null,
                    "K_Average":"' . round($opacity, 2) . '",
                    "Accelerations": [
                        {
                            "K":"' . round($opacity, 2) . '",
                            "RPM_Idle": 0,
                            "RPM_Fast": 0,
                            "Oil_Temperature": 0
                        }
                    ],
                    "Verdict": 1
                }
            ],
            "Result_K": "' . round($opacity, 2) . '",
            "Verdict": 1
        }';

    $OverallResult = "";

    if ($OverallResult == "" || $OverallResult == NULL) {
        $OverallResult = 1;
    }

    $light_data = "";
    $light_data = ' {
            "Status": {
                "Status": ' . $OverallResult . ',
                "Remarks": "PASSED"
            },
            "DateTime_Start": "' . $datetime_start . '",
            "DateTime_End": "' . $datetime_end . '",
            ' . $light . '
            "Fog_Beams": null,
            "Verdict": 1
        }';

    $angle_data = "";
    $angle_data = null;

    $sideslip_data = "";
    $sideslip_data = '{
            "Status": {
                "Status": 1,
                "Remarks": "PASSED"
            },
            "DateTime_Start":"' . $datetime_start . '",
            "DateTime_End": "' . $datetime_end . '",
            "Axle": [
                {
                    "Value": -0.05
                },
                {
                    "Value": 8.0
                }
            ],
            "Verdict": 1
        }';

    $suspension_data = "";
    $suspension_data = '{
            "Status": {
                "Status": 1,
                "Remarks": "PASSED"
            },
            "DateTime_Start": "' . $datetime_start . '",
            "DateTime_End": "' . $datetime_end . '",
            "Axle": [
                    ' . $suspension_row . '
            ],
            "Verdict": 1
        }';

    $brakes_data = "";
    $brakes_data = '{
            "Status": {
                "Status": 1,
                "Remarks": "PASSED"
            },
            "DateTime_Start":"' . $datetime_start . '",
            "DateTime_End":"' . $datetime_end . '",
            "Axle": [
                {
                    ' . $brake_axel1 . '
                },
                {
                    ' . $brake_axel2 . '
                    ' . $brake_axel3 . '
                }
            ],
            "Globals": {
                "Service_Efficiency_Measured": 0.0,
                "Parking_Efficiency_Measured": 0.0,
                "Service_Efficiency_Calculated": 0.0,
                "Parking_Efficiency_Calculated": 0.0
            },
            "Verdict": 1
        }';

    $measured_speed = "";
    if ($measured_speed == "" || $measured_speed == NULL) {
        $measured_speed = 1;
    }
    $speedometer_data = "";
    $speedometer_data = '{
            "Status": {
                "Status": 1,
                "Remarks": "PASSED"
            },
            "DateTime_Start":"' . $datetime_start . '",
            "DateTime_End": "' . $datetime_end . '",
            "Target_Speed": 30,
            "Speed_Point": [
                {
                    "Value": ' . $measured_speed . '
                }
            ],
            "Verdict": 1
        }';

    $defects_data = "";

    $defects_data = '{
            "Defects": [
                {
                    "ID": 1,
                    "Description": "Body Appearance",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score1 . ',
                    "Verdict": 1
                },
                {
                    "ID": 2,
                    "Description": "Chassis",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score2 . ',
                    "Verdict": 1
                },
                {
                    "ID": 3,
                    "Description": "Engine",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score3 . ',
                    "Verdict": 1
                },
                {
                    "ID": 4,
                    "Description": "Handle Bars",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score4 . ',
                    "Verdict": 1
                },
                {
                    "ID": 5,
                    "Description": "Wiper / Washer",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score5 . ',
                    "Verdict": 1
                },
                {
                    "ID": 6,
                    "Description": "Windshield / Window Glass",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score6 . ',
                    "Verdict": 1
                },
                {
                    "ID": 7,
                    "Description": "Headlights",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score7 . ',
                    "Verdict": 1
                },
                {
                    "ID": 8,
                    "Description": "Signal Lights (front)",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score8 . ',
                    "Verdict": 1
                },
                {
                    "ID": 9,
                    "Description": "Signal Lights (rear)",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score9 . ',
                    "Verdict": 1
                },
                {
                    "ID": 10,
                    "Description": "Parking Lights (front)",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score10 . ',
                    "Verdict": 1
                },
                {
                    "ID": 11,
                    "Description": "Parking Lights (rear)",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score11 . ',
                    "Verdict": 1
                },
                {
                    "ID": 12,
                    "Description": "Brake Lights",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score12 . ',
                    "Verdict": 1
                },
                {
                    "ID": 13,
                    "Description": "Back-up Lights",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score13 . ',
                    "Verdict": 1
                },
                {
                    "ID": 15,
                    "Description": "Number Plate / Lights",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score14 . ',
                    "Verdict": 1
                },
                {
                    "ID": 16,
                    "Description": "Hazard Lights",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score15 . ',
                    "Verdict": 1
                },
                {
                    "ID": 17,
                    "Description": "Reflectors",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score16 . ',
                    "Verdict": 1
                },
                {
                    "ID": 18,
                    "Description": "Interior Lights",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score17 . ',
                    "Verdict": 1
                },
                {
                    "ID": 20,
                    "Description": "Seat Belts",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score20 . ',
                    "Verdict": 1
                },
                {
                    "ID": 21,
                    "Description": "Horn",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score21 . ',
                    "Verdict": 1
                },
                {
                    "ID": 22,
                    "Description": "Door / Hinges",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score22 . ',
                    "Verdict": 1
                },
                {
                    "ID": 23,
                    "Description": "Floor Board",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score23 . ',
                    "Verdict": 1
                },
                {
                    "ID": 24,
                    "Description": "Side Mirror / Rear View",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score24 . ',
                    "Verdict": 1
                },
                {
                    "ID": 26,
                    "Description": "Brake System",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score26 . ',
                    "Verdict": 1
                },
                {
                    "ID": 27,
                    "Description": "Drivers  / Passengers Seat",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score27 . ',
                    "Verdict": 1
                },
                {
                    "ID": 28,
                    "Description": "Steering",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score28 . ',
                    "Verdict": 1
                },
                {
                    "ID": 29,
                    "Description": "Tires / Wheels",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score29 . ',
                    "Verdict": 1
                },
                {
                    "ID": 30,
                    "Description": "Wheels Bolts / Nuts",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score30 . ',
                    "Verdict": 1
                },
                {
                    "ID": 31,
                    "Description": "Fuel Tank / Cap",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score31 . ',
                    "Verdict": 1
                },
                {
                    "ID": 32,
                    "Description": "Panel Gauges",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score32 . ',
                    "Verdict": 1
                },
                {
                    "ID": 33,
                    "Description": "Radiator",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score33 . ',
                    "Verdict": 1
                },
                {
                    "ID": 34,
                    "Description": "Engine Bracket / Mounting",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score34 . ',
                    "Verdict": 1
                },
                {
                    "ID": 35,
                    "Description": "Engine Oil Leakage",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score35 . ',
                    "Verdict": 1
                },
                {
                    "ID": 36,
                    "Description": "Transmission Oil Leakage",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score36 . ',
                    "Verdict": 1
                },
                {
                    "ID": 37,
                    "Description": "Steering Ball Joints",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score37 . ',
                    "Verdict": 1
                },
                {
                    "ID": 38,
                    "Description": "Steering Leackages / Gear Box Mounting",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score38 . ',
                    "Verdict": 1
                },
                {
                    "ID": 40,
                    "Description": "Front Shackle Eyes / Pins / Bushes",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score40 . ',
                    "Verdict": 1
                },
                {
                    "ID": 41,
                    "Description": "Rear Shackle / Pins / Bushes",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score41 . ',
                    "Verdict": 1
                },
                {
                    "ID": 42,
                    "Description": "Stabilizer / Bushes",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score42 . ',
                    "Verdict": 1
                },
                {
                    "ID": 44,
                    "Description": "Front Suspension Joints / Bushes",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score44 . ',
                    "Verdict": 1
                },
                {
                    "ID": 45,
                    "Description": "Rear Suspension Joints / Bushes",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score45 . ',
                    "Verdict": 1
                },
                {
                    "ID": 46,
                    "Description": "Rear Linkages",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score46 . ',
                    "Verdict": 1
                },
                {
                    "ID": 63,
                    "Description": "EWD",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score63 . ',
                    "Verdict": 1
                },
                {
                    "ID": 64,
                    "Description": "Color",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score64 . ',
                    "Verdict": 1
                },
                {
                    "ID": 65,
                    "Description": "Diesel Fuel System Seal",
                    "Motive": "",
                    "Observation": "",
                    "Picture": "",
                    "Severity": ' . $Score65 . ',
                    "Verdict": 1
                }
            ]
        }';

    if (($category == "Motorcycle") or ($category == "Moped") or ($category == "Motorcyle without Sidecar") or ($category == "Motorcycle / Moped /Motorcyle without Sidecar")) {
        $stage_no_data = "M1";
    } else if (($category == "SUV") or ($category == "Utility Vehicle")) {
        $stage_no_data = "L1e";
    } else if (($category == "Truck")) {
        $stage_no_data = "N1";
    } else {
        $stage_no_data = "M2";
    }

    #endregion

    $newdata = ' { 
            "MODE"  : "' . $mode_data . '", 
            "QUEUE_ID"  : "", 
            "INSPECTION_ID"  : "' . $Inspection_ID . '", 
            "INSPECTOR_USERNAME" : "' . $inspector_name . '", 
            "STAGE_NO"  : "' . $stage_no_data . '", 
            "INSPECTION_REF_NO" : "' . $transaction_no . '", 
            "TRANSACTION_NO" :  "' . $transaction_no . '", 
            "PURPOSE" :  "' . $purpose_data . '", 
            "PMVIC_CENTER" :  "' . $pmvic_center_data . '", 
            "ITP_CODE" :  "' . $itp_code_data . '", 
            "VEHICLE_INFORMATION" :  ' . $vehicle_information_data . ', 
            "NOISE" :  ' . $noise_data . ', 
            "EMISSIONS" :  ' . $emission_data . ', 
            "OPACITY" :  ' . $opacity_data . ', 
            "LIGHTS" :  ' . $light_data . ', 
            "SPEEDOMETER" :  ' . $speedometer_data . ', 
            "SIDESLIP" : ' . $sideslip_data . ', 
            "SUSPENSION" :  ' . $suspension_data . ', 
            "BRAKES" :  ' . $brakes_data . ',  
            "DEFECTS" :  ' . $defects_data . '
            }';

    // $url="https://pmvic.api.lto.direct/ords/dl_interfaces/interface_PMVIC/v3/store_testresults";
    // $curl = curl_init($url);
    // curl_setopt($curl, CURLOPT_URL, $url);
    // curl_setopt($curl, CURLOPT_POST, true);
    // curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    // $headers = array("Content-Type: application/json",);
    // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


    // curl_setopt($curl, CURLOPT_POSTFIELDS, $newdata);


    // curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    // curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    // $resp = curl_exec($curl);
    // curl_close($curl);

    // $data = json_decode($resp, true);

    // echo json_encode($data);


    $responseApi = '{
        "RESPONSE": "SUCCESS",
        "DATE_SENT": "2023-07-29T18:14:01",
        "PMVIC_MANAGER": "",
        "INSPECTION_REFERENCE_NO": "21212121212",
        "OVERALL_EVALUATION": -1,
        "TRANSACTION_NO": "21212121212",
        "PMVIC_TESTS": {
            "NOISE_TEST": 1,
            "EMISSION_TEST": 1,
            "OPACITY_TEST": 0,
            "LIGHT_TEST": -1,
            "SIDESLIP_TEST": 1,
            "SPEED_TEST": 0,
            "SUSPENSION_TEST": 1,
            "BRAKES_TEST": -1,
            "VISUAL_DEFECTS_FOUND": 2
        },
        "LTO_EVALUATION": {
            "NOISE_TEST": {
                "PIPE1": {
                    "ENGINE": 1,
                    "EXHAUST": 1,
                    "HORN": 1
                },
                "NOISE_VERDICT": 1
            },
            "EMISSION_TEST": {
                "RESULT_HC": null,
                "RESULT_CO": null,
                "EMISSION_VERDICT": null
            },
            "OPACITY_TEST": {
                "OPACITY_VERDICT": -1
            },
            "LIGHT_TEST": {
                "LIGHT_VERDICT": -1
            },
            "SIDESLIP_TEST": {
                "AXLE1": 1,
                "AXLE2": -1,
                "SIDESLIP_VERDICT": -1
            },
            "SPEED_TEST": {
                "SPEED1": 1,
                "SPEEDOMETER_VERDICT": 1
            },
            "SUSPENSION_TEST": {
                "AXLE1": {
                    "LEFT": 1,
                    "RIGHT": 1
                },
                "AXLE2": {
                    "LEFT": 1,
                    "RIGHT": 1
                },
                "SUSPENSION_VERDICT": 1
            },
            "BRAKES_TEST": {
                "AXLE1": {
                    "SERVICE": {
                        "DIFFERENCE": 1
                    }
                },
                "AXLE2": {
                    "SERVICE": {
                        "DIFFERENCE": -1
                    }
                },
                "PARKING_EFFICIENCY": 1,
                "SERVICE_EFFICIENCY": 1,
                "BRAKES_VERDICT": -1
            },
            "DEFECTS_EVALUATION": {
                "VISUAL_VERDICT": -1
            }
        }
    }';

    $decodeData = json_decode($responseApi);

    if ($decodeData->RESPONSE == 'SUCCESS') {
        $tbl_upload = new Upload();

        $tbl_upload->id        = htmlspecialchars(trim($_POST["id"]));
        $tbl_upload->PLATE_NUM = htmlspecialchars(trim($_POST["plate-upload"]));
        $tbl_upload->MV_FILE   = htmlspecialchars(trim($_POST["mvfile-upload"]));

        $tbl_upload->OVERALL_EVALUATION = $responseApi;
        $tbl_upload->INSPECTION_REF_NO  = $decodeData->INSPECTION_REFERENCE_NO;
        $tbl_upload->SUCCESS_LOG        = $decodeData->RESPONSE;

        $result = $tbl_upload->UpdateReUpload();

        echo json_encode($result);
    }
}
