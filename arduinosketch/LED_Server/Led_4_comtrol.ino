 #include <ESP8266WiFi.h>
const char* ssid = "EWHA-IOT";
const char* password = "dscho007";
int LED_pin[4] = {14, 12, 13, 15};
int i;
WiFiServer server(80); 
void setup() {
  Serial.begin(115200);
  delay(10);
  for(i=0;i<4;i++) {
    pinMode(LED_pin[i], OUTPUT);     // Initialize the LED_BUILTIN pin as an output
  digitalWrite(LED_pin[i], LOW); //LED off
  } 
  Serial.println();
  Serial.println();
  Serial.println("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.println(".");
  }
  Serial.println("");
  Serial.println("WiFi Connected");
  server.begin(); 
  Serial.println("Server started");
  Serial.println("Use this URL to connect: ");
  Serial.println("http://");
  Serial.println(WiFi.localIP());
  Serial.println("/");
}
void loop() {
  WiFiClient client = server.available();
  if(!client) {
    return;
  }
  Serial.println("new client");
  while(!client.available()){
    delay(1);
  }
  String request = client.readStringUntil('\r');
  Serial.println(request);
  client.flush(); 
   int value = LOW;
  if (request.indexOf("/LED1=ON") != -1) {
    digitalWrite(LED_pin[0], HIGH);
    value = HIGH;   
  }    
  if(request.indexOf("/LED1=OFF") != -1) {
   digitalWrite(LED_pin[0], LOW);
    value = LOW;
  }
      if (request.indexOf("/LED2=ON") != -1) {
    digitalWrite(LED_pin[1], HIGH);
    value = HIGH;   
  }    
  if(request.indexOf("/LED2=OFF") != -1) {
   digitalWrite(LED_pin[1], LOW);
    value = LOW;
  }
    if (request.indexOf("/LED3=ON") != -1) {
    digitalWrite(LED_pin[2], HIGH);
    value = HIGH;   
  }    
  if(request.indexOf("/LED3=OFF") != -1) {
   digitalWrite(LED_pin[2], LOW);
    value = LOW;
  }
    if (request.indexOf("/LED4=ON") != -1) {
    digitalWrite(LED_pin[3], HIGH);
    value = HIGH;   
  }    
  if(request.indexOf("/LED4=OFF") != -1) {
   digitalWrite(LED_pin[3], LOW);
    value = LOW;
  }
  client.println("HTTP/1.1 200 OK");
  client.println("Content-Type: text/html");
  client.println("");
  client.println("<!DOCTYPE HTML>");
  client.println("<html>");
  client.println("<head>");
  client.println("<title>NodeMCU Control</title>");
  client.println("<meta name='viewport' content='width=device-width, user-scalable=no'>");
  client.println("</head>");
  client.println("<body>");
  client.println("<div style='width: 300px; margin: auto; text-align: center;'>");
  client.println("<h3>NodeMCU Web Server</h3>");
  client.println("<p>");
  client.print("Led pin is now : ");
  if(value == HIGH) {
    client.println("On");
  } else {
    client.println("Off");
  }
  client.println("</p>");
  client.println("<a href=\"/LED1=ON\"\"><button>LED1 Turn On </button></a>");
  client.println("<a href=\"/LED1=OFF\"\"><button>LED1 Turn Off </button></a><br />"); 
  client.println("<a href=\"/LED2=ON\"\"><button>LED2 Turn On </button></a>");
  client.println("<a href=\"/LED2=OFF\"\"><button>LED2 Turn Off </button></a><br />"); 
  client.println("<a href=\"/LED3=ON\"\"><button>LED3 Turn On </button></a>");
  client.println("<a href=\"/LED3=OFF\"\"><button>LED3 Turn Off </button></a><br />");   
  client.println("<a href=\"/LED4=ON\"\"><button>LED4 Turn On </button></a>");
  client.println("<a href=\"/LED4=OFF\"\"><button>LED4 Turn Off </button></a><br />"); 
    client.println("</div>");
  client.println("</body>");
  client.println("</html>");
  delay(1);
  Serial.println("Client disconnected");
  Serial.print("");  
}
