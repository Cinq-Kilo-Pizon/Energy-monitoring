const mqtt = require('mqtt');

// MQTT broker details
const host = 'wss://5e56c1ec0654438786dd14167b41b7b8.s1.eu.hivemq.cloud';
const port = 8884;
const clientId = 'client' + Math.random().toString(16).substr(2, 8);
const username = 'EETCO'; // Insert your MQTT username here
const password = 'EEtco2024'; // Insert your MQTT password here

// Connect options
const connectOptions = {
  host: host,
  port: port,
  clientId: clientId,
  username: username,
  password: password,
  protocol: 'wss',
  rejectUnauthorized: false // Adjust based on your security requirements
};

// Connect to MQTT broker
const client = mqtt.connect(connectOptions);

// Event handler for when the client is connected
client.on('connect', () => {
  console.log('Connected to MQTT broker');
  
  // Publish a message to a topic
  const topic = 'hola';
  const message = 'Hello, MQTT!';
  client.publish(topic, message, (err) => {
    if (err) {
      console.error('Error publishing message:', err);
    } else {
      console.log('Message published successfully');
      client.end(); // Disconnect after publishing
    }
  });
});

// Event handler for when an error occurs
client.on('error', (err) => {
  console.error('Error:', err);
});
