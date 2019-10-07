from gpiozero import LED
from time import sleep

led2 = LED(2)

led3 = LED(3)

led4 = LED(4)


print('GPIO toggling starting...')
led2.on()
sleep(1);
led2.off()
sleep(1);
for count in range(2):
  led3.on()
  sleep(0.5);
  led3.off()
  sleep(0.5);
led4.on()
sleep(1);
led4.off()
print('GPIO toggling done')