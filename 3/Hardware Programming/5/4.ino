//soal4

const int len = 4; 
const int lenz = 5; 
int a[len] = {2,5,9,11};
int b[lenz] = {1,3,7,10,12};
int c[];

void setup() {
  for (int i=0;len-1>=i&&lenz-1>=i;i++){


    if (a[i]<b[i])
    {
      c[i]=a[i];
      c[i++]=b[i];
      }
    else if(a[i]>b[i]){
      c[i]=b[i];
      c[i++]=b[i];
    }
    else//same num
    c[i]=a[i];
    

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
