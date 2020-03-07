# MoWaS

The **mowas.php** reads MoWaS-messages from the json-source @ bbk and prepares the messages for DAPNET-transmission:

* prepend a regional code (from sender-field)
* insert a 'E:' for 'Entwarnung oder 'W:' for 'Warnung' before message-headline
* replace 'Umlaute' in message
* shorten the message to 78 chars and add '..' to mark shorten messages
* add ' #' to mark messages that have less 79 chars and are complete

Examples:

```MV-SN W:Korrektur - Internetadressen des Landesamtes fuer Gesundheit und Sozia..```

```NW-VIE E:Sirenenprobe #```

See the script in live-demo:

https://db0usd.ralsu.de/mowas.php

This script does not contain any DAPNET-connectivity. You have to add DAPNET-rubric-submission-code to this script or you have to include the code in your existing DAPNET-scripts.

Feel free to use the code. If you like it, send me a message ;-)

73 de do6uk 
Rainer
