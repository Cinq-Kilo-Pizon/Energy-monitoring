let mqttClient;

window.addEventListener("load", (event) => {
  connectToBroker();

  const publishBtn1 = document.querySelector(".on1");
  const publishBtn2= document.querySelector(".on2");
  const publishBtn3 = document.querySelector(".off1");
  const publishBtn4 = document.querySelector(".off2");

  publishBtn1.addEventListener("click", function () {
    publishMessage1();
  });

  publishBtn2.addEventListener("click", function () {
    publishMessage2();
  });

  publishBtn3.addEventListener("click", function () {
    publishMessage3();
  });

  publishBtn4.addEventListener("click", function () {
    publishMessage4();
  });
});

function connectToBroker() {
  const clientId = "client" + Math.random().toString(36).substring(7);

  // Change this to point to your MQTT broker
  const host = "wss://5e56c1ec0654438786dd14167b41b7b8.s1.eu.hivemq.cloud:8884/mqtt";
  const username = "EETCO"; // Insert your MQTT username here
  const password = "EEtco2024"; // Insert your MQTT password here
  const options = {
    keepalive: 60,
    clientId: clientId,
    protocolId: "MQTT",
    protocolVersion: 4,
    clean: true,
    reconnectPeriod: 1000,
    connectTimeout: 30 * 1000,
    username: username,
    password: password
  };

  mqttClient = mqtt.connect(host, options);

  mqttClient.on("error", (err) => {
    console.log("Error: ", err);
    mqttClient.end();
  });

  mqttClient.on("reconnect", () => {
    console.log("Reconnecting...");
  });

  mqttClient.on("connect", () => {
    console.log("Client connected:" + clientId);
  });

  // Received
  mqttClient.on("message", (topic, message, packet) => {
    console.log(
      "Received Message: " + message.toString() + "\nOn topic: " + topic
    );
  });
}

function publishMessage1() {
  // Specify the static topic and message
  const topic = "hola";
  const message = "On 1, MQTT!";

  console.log(`Sending Topic: ${topic}, Message: ${message}`);

  mqttClient.publish(topic, message, {
    qos: 0,
    retain: false,
  });
}
function publishMessage2() {
  // Specify the static topic and message
  const topic = "hola";
  const message = "On 2, MQTT!";

  console.log(`Sending Topic: ${topic}, Message: ${message}`);

  mqttClient.publish(topic, message, {
    qos: 0,
    retain: false,
  });
}
function publishMessage3() {
  // Specify the static topic and message
  const topic = "hola";
  const message = "Off 1, MQTT!";

  console.log(`Sending Topic: ${topic}, Message: ${message}`);

  mqttClient.publish(topic, message, {
    qos: 0,
    retain: false,
  });
}
function publishMessage4() {
  // Specify the static topic and message
  const topic = "hola";
  const message = "Off 2, MQTT!";

  console.log(`Sending Topic: ${topic}, Message: ${message}`);

  mqttClient.publish(topic, message, {
    qos: 0,
    retain: false,
  });
}