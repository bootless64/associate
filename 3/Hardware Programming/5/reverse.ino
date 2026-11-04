//reverse
const int len = 8; 
int a[len] = {125, 1920, 503, 299, 67, 13578, 7632, 22043};
int b;
void setup() {
  Serial.begin(9600);
for (int i=0,j=len-1;j>=i;i++,j--){
    b=a[i];
    a[i]=a[j];
    a[j]=b;
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
