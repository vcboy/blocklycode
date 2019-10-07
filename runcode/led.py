from gpiozero import LED
from time import sleep
import os
os.environ["PIGPIO_ADDR"] = "192.168.1.6"
os.environ["GPIOZERO_PIN_FACTORY"] = "pigpio"

red = LED(5)

while True:
    red.on()
    sleep(1)
    red.off()
    sleep(1)