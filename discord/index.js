require('dotenv').config(); //initialize dotenv
const axios = require('axios'); //add this line at the top
const { Client, Intents } = require('discord.js');

const client = new Client({ intents: [Intents.FLAGS.GUILDS, Intents.FLAGS.GUILD_MESSAGES] });

client.on('ready', () => {
  console.log(`Logged in as ${client.user.tag}!`);
});

client.on("messageCreate", async (message) => {
  if (message.author.bot) return false;

  console.log(`Message from ${message.author.username}: ${message.content}`);

  switch( message.content ) {
    case "ping":
      message.reply( "Pong Bitch!" );
      break;
    case "lunch menu":
      message.channel.send("Here's your latest visits!"); //Replies to user command
      const lunchResult = await getLunch();
      message.channel.send( lunchResult ); //send the image URL
      break;

  }
});

async function getLunch(){
  const res = await axios.get('https://penguinore.net/lunch_yap/api.php?search=last_visit&quadrant=Henrietta');
  return res.data;
}

//make sure this line is the last line
client.login(process.env.CLIENT_TOKEN); //login bot using token