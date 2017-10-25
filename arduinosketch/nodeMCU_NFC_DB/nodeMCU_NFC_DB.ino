#include <ESP8266WiFi.h>
#include <Wire.h>
#include <SPI.h>
#include <Adafruit_PN532.h>

// NFC module
#define PN532_SCK   D1
#define PN532_MOSI  D2
#define PN532_MISO  D3
#define PN532_SS    D0
Adafruit_PN532 nfc(PN532_SCK, PN532_MISO, PN532_MOSI, PN532_SS);

// forward declaration of helper function to get UID as HEX-String
void byteToHexString(String &dataString, byte *uidBuffer, byte bufferSize, String strSeperator);

const char *ssid = "EWHA-IOT";
const char *password = "dscho007";

const char* host = "192.168.0.19";

void setup() {
  Serial.begin(115200);
  delay(10);

  // start nfc
  Serial.println("Initial nfc module");
  nfc.begin();
  uint32_t versiondata = nfc.getFirmwareVersion();
  if (! versiondata) {
    Serial.print("Didn't find PN53x board");
    while (1); // halt
  }

  // Got ok data, print it out!
  Serial.print("Found chip PN5"); Serial.println((versiondata>>24) & 0xFF, HEX); 
  Serial.print("Firmware ver. "); Serial.print((versiondata>>16) & 0xFF, DEC); 
  Serial.print('.'); Serial.println((versiondata>>8) & 0xFF, DEC);

  // Set the max number of retry attempts to read from a card
  // This prevents us from waiting forever for a card, which is
  // the default behaviour of the PN532.
  nfc.setPassiveActivationRetries(0xFF);

  // configure board to read RFID tags
  nfc.SAMConfig();

  Serial.println("Waiting for an ISO14443A card");
  Serial.println("Initial tft display");
  // start by connecting to a WiFi network
  Serial.println();
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  
  WiFi.begin(ssid, password);
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.println("IP address: ");
  Serial.println(WiFi.localIP());
}

int value = 0;

void loop() {
  //read nfc
  boolean success;
  String strUID;
  uint8_t uid[] = { 0, 0, 0, 0, 0, 0, 0 };  // Buffer to store the returned UID
  uint8_t uidLength;                // Length of the UID (4 or 7 bytes depending on ISO14443A card type)

  // Wait for an ISO14443A type cards (Mifare, etc.).  When one is found
  // 'uid' will be populated with the UID, and uidLength will indicate
  // if the uid is 4 bytes (Mifare Classic) or 7 bytes (Mifare Ultralight)
  success = nfc.readPassiveTargetID(PN532_MIFARE_ISO14443A, uid, &uidLength);

  if (success) {
    Serial.println("Found a card!");
    Serial.print("UID Length: ");Serial.print(uidLength, DEC);Serial.println(" bytes");
    Serial.print("UID Value: ");
    // store UID as HEX-String to strUID and print it to display
    byteToHexString(strUID, uid, uidLength, "-");
    Serial.println("");
    Serial.println(strUID);
    delay(1000);
  }
  else
  {
    Serial.println("Timed out or waiting for a card");
  }

  Serial.print("connecting to ");
  Serial.println(host);
  
  // Use WiFiClient class to create TCP connections
  WiFiClient client;
  const int httpPort = 80;

  if(strUID){
      Serial.print("connecting to php file1 ");
     if (client.connect(host, httpPort)) { //HTTP 요청 헤더
      Serial.print("connecting to php file2 ");
      client.print( "GET /test1.php?"); //읽을 PHP 파일
      client.print("strUID=");
      client.print( strUID ); //여기까지는 PHP에서 받기로한 데이터들이다
      client.println( " HTTP/1.1");
      client.println( "Host: localhost" ); //요청을 보낼 서버의 주소
      client.println( "Content-Type: application/x-www-form-urlencoded" );    
      client.println( "Connection: close" );
      client.println();
      client.stop();
  }
  delay(5000);
  ++value;
  }
}

// helper function to get UID as HEX-String
void byteToHexString(String &dataString, byte *uidBuffer, byte bufferSize, String strSeperator=":") {
  dataString = "";
  for (byte i = 0; i < bufferSize; i++) {
    if (i>0) {
      dataString += strSeperator;
      if (uidBuffer[i] < 0x10)
        dataString += String("0");
    }
    dataString += String(uidBuffer[i], HEX);
  }
  dataString.toUpperCase();
}
