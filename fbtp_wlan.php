<?php if(!defined('fb_tools')) die("Plugin-File for fb_tools");	// (charset=iso-8859-1 / tabs=4 / lines=cr+lf / lang=de)

    $plugin = "WLAN-Ger�te (c) 21.02.2020 by Jannik Heuer";
    $info = 'F�gt Ger�t zu WLAN-Ger�ten f�r beschr�nkten Zugiff hinzu.'; 

    if(ifset($cfg['help']) or !getArg(true)) {						// Hilfe Ausgeben
        out("$plugin\n$info\n\n$self <fritz.box> Plugin $plug mac:\"<MAC-Addresse>\" \n\nBeispiel:\n$self fritz.box plugin $plug mac:\"AA:BB:CC:11:22:33\"\n\n");
    }elseif($mac = getArg("mac")){
        // Try Login
        if($sid = (ifset($cfg['bsid'])) ? $cfg['bsid'] : login()){
            out("F�ge Ger�t $mac zu WLAN-Ger�ten hinzu");
            // Split MAC into digits
            $mac_digits = explode(":",$mac);

            // Add Mac to WLAN-Devices
            $result = request('POST','/data.lua',"xhr=1&mac0=$mac_digits[0]&mac1=$mac_digits[1]&mac2=$mac_digits[2]&mac3=$mac_digits[3]&mac4=$mac_digits[4]&mac5=$mac_digits[5]&infoDialogSeen=0&back_to_page=wKey&sid=$sid&apply=&lang=de&page=add_by_mac");
            if (strpos($result, "\"apply\":\"ok\"")) {
                out("Ger�t $mac erfolgreich hinzugef�gt");
            }else{
                out("Ger�t $mac konnte nicht hinzugef�gt werden.");
            }
        }
    }

?>