//delete

const int len = 8; 
int a[len] = {125, 1920, 503, 299, 67, 13578, 7632, 22043};
int b=299;

void setup() {
    Serial.begin(9600);
  for (int i=0,j=1;len-1>=i;i++,j++){
    if(b==a[i]){
      for (;len-1>=i;i++,j++){
        a[i]=a[j];
      }
      break;
    }else
    continue;
  }

}

void loop() {

  for (int i=0;len-1>=i;i++){
    if(i==0)
    Serial.println("Starting from here");
  
    Serial.println(a[i]);
    delay(1000);
  }
  delay(5000);

}
