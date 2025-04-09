import paho.mqtt.client as mqtt
from db import query_db


def on_connect(client, userdata, flags, reason_code, properties):
    print(f"Connected with result code {reason_code}")
    client.subscribe("cansat/#")


def on_message(client, userdata, msg):
    message = str(msg.payload.decode("utf-8"))
    print(msg.topic+" "+ message)

    try:
        query_db(
            f"""INSERT INTO data (id, message_type, message) VALUES (NULL, '{msg.topic}', '{message}');"""
        )
    except Exception as e:
        print(e)
    finally:
        print(query_db(
            """SELECT * FROM data ORDER BY id DESC LIMIT 1"""
        ))

def begin():
    mqttc = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)
    mqttc.on_connect = on_connect
    mqttc.on_message = on_message

    mqttc.connect("194.160.224.5", 23456)

    mqttc.loop_forever()


if __name__ == "__main__":
    begin()