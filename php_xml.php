<?php

// proper xml, passes without error.
$myXMLData =
"<?xml version='1.0' encoding='UTF-8'?>
<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don't forget me this weekend!</body>
</note>";

$xml = simplexml_load_string($myXMLData);
if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
	echo "<br>";
    print_r($xml);
}
echo "<br><br>";
// xml containing errors, with handling in place. 
libxml_use_internal_errors(true);
$myXMLData =
"<?xml version='1.0' encoding='UTF-8'?>
<document>
<user>John Doe</wronguser>
<email>john@example.com</wrongemail>
</document>";

$xml = simplexml_load_string($myXMLData);
if ($xml === false) {
    echo "Failed loading XML: ";
    foreach(libxml_get_errors() as $error) {
        echo "<br>", $error->message;
    }
} else {
    print_r($xml);
}
echo "<br><br>";
// Reading from an XML file
$xml=simplexml_load_file("note.xml") or die("Error: Cannot create object");
print_r($xml);
echo "<br>";
// Get Node values
echo $xml->to . "<br>";
echo $xml->from . "<br>";
echo $xml->heading . "<br>";
echo $xml->body . "<br>";
echo "<br><br>";
// Get node values (of specific elements) from another xml file, books.xml
$xml=simplexml_load_file("books.xml") or die("Error: Cannot create object");
echo $xml->book[0]->title . "<br>";
echo $xml->book[1]->title . "<br>";

// loop through all books
foreach($xml->children() as $books) {
	echo $books->title . ", ";
	echo $books->author . ", ";
	echo $books->year . ", ";
	echo $books->price . " <br>";
}

// The following example gets the attribute value of the "category" attribute of the first <book> element and the attribute value of the "lang" attribute of the <title> element in the second <book> element
echo $xml->book[0]['category'] . "<br>";
echo $xml->book[1]->title['lang'] . "<br>";
echo "<br>";
// The following example gets the attribute values of the <title> elements in the "books.xml" file
foreach($xml->children() as $books) {
    echo $books->title['lang'];
    echo "<br>";
}
echo "<br>";

// The XML Expat Parser
// <from>Jani</from>
/* An event-based parser reports the XML above as a series of three events:
Start element: from
Start CDATA section, value: Jani
Close element: from
*/
// Initialize the XML parser
$parser=xml_parser_create();

// Function to use at the start of an element
function start($parser,$element_name,$element_attrs) {
  switch($element_name) {
    case "NOTE":
    echo "-- Note --<br>";
    break;
    case "TO":
    echo "To: ";
    break;
    case "FROM":
    echo "From: ";
    break;
    case "HEADING":
    echo "Heading: ";
    break;
    case "BODY":
    echo "Message: ";
  }
}

// Function to use at the end of an element
function stop($parser,$element_name) {
  echo "<br>";
}

// Function to use when finding character data
function char($parser,$data) {
  echo $data;
}

// Specify element handler
xml_set_element_handler($parser,"start","stop");

// Specify data handler
xml_set_character_data_handler($parser,"char");

// Open XML file
$fp=fopen("note.xml","r");

// Read data
while ($data=fread($fp,4096)) {
  xml_parse($parser,$data,feof($fp)) or
  die (sprintf("XML Error: %s at line %d",
  xml_error_string(xml_get_error_code($parser)),
  xml_get_current_line_number($parser)));
}

// Free the XML parser
xml_parser_free($parser);

/*
Initialize the XML parser with the xml_parser_create() function
Create functions to use with the different event handlers
Add the xml_set_element_handler() function to specify which function will be executed when the parser encounters the opening and closing tags
Add the xml_set_character_data_handler() function to specify which function will execute when the parser encounters character data
Parse the file "note.xml" with the xml_parse() function
In case of an error, add xml_error_string() function to convert an XML error to a textual description
Call the xml_parser_free() function to release the memory allocated with the xml_parser_create() function
*/


// The XML DOM Parser
// <?xml version="1.0" encoding="UTF-8" ? >
// <from>Jani</from>
/*
The DOM sees the XML above as a tree structure:

Level 1: XML Document
Level 2: Root element: <from>
Level 3: Text element: "Jani"
*/

// We want to initialize the XML parser, load the xml, and output it
$xmlDoc = new DOMDocument();
$xmlDoc->load("note.xml");

print $xmlDoc->saveXML();
echo "<br>";

// loop through all elements of <note> element
$x = $xmlDoc->documentElement;
foreach ($x->childNodes AS $item) {
  print $item->nodeName . " = " . $item->nodeValue . "<br>";
}


?>