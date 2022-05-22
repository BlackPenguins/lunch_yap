require('dotenv').config(); //initialize dotenv
const axios = require('axios'); //add this line at the top
const { Client, Intents } = require('discord.js');

const client = new Client({ intents: [Intents.FLAGS.GUILDS, Intents.FLAGS.GUILD_MESSAGES] });

client.on('ready', () => {
  console.log(`Logged in as ${client.user.tag}!`);
});

client.on("messageCreate", (message) => {
  if (message.author.bot) return false;

  console.log(`Message from ${message.author.username}: ${message.content}`);

  switch( message.content ) {
    case "ping":
      message.reply( "Pong Bitch!" );
      break;
    case "lunch menu":
      
  }
});

//make sure this line is the last line
client.login(process.env.CLIENT_TOKEN); //login bot using token