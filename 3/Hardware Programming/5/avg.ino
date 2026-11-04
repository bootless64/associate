// avg sum min max
const int len = 8; 
int a[len] = {125, 1920, 503, 299, 67, 13578, 7632, 22043};

int mini,maxi;

float average=0,sum=0;


void setup() {
  Serial.begin(9600);
  
  for (int i=0;len-1>=i;i++){
    sum+=a[i];
    if(i==0)
      mini=maxi=a[i];
    else if(a[i]<mini)
      mini=a[i];
    else if (a[i]>maxi)
    maxi=a[i];
  }
    

  average=sum/len;

}
void loop() {
  Serial.print("sum of array a is: ");
  Serial.println(sum);
  delay(500);
  Serial.print("max number in array a is: ");
  Serial.println(maxi);
  delay(500);
  Serial.print("min number in array a is: ");
  Serial.println(mini);
  delay(500);
  Serial.print("averange of array a is: ");
  Serial.println(average,4);
  
  delay(5000);
  
}
