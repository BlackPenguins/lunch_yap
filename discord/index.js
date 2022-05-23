require('dotenv').config(); //initialize dotenv
const axios = require('axios'); //add this line at the top
const {Client, Intents} = require('discord.js');

const client = new Client({intents: [Intents.FLAGS.GUILDS, Intents.FLAGS.GUILD_MESSAGES]});

client.on('ready', () => {
    console.log(`Logged in as ${client.user.tag}!`);
});

client.on("messageCreate", async (message) => {
    if (message.author.bot) return false;

    console.log(`Message from ${message.author.username}: ${message.content}`);

    switch (message.content) {
        case "ping":
            message.reply("Pong Bitch!");
            break;
    }

    if (message.content.startsWith("lunch in")) {
        let location = message.content.replace( "lunch in", "" ).trim();
        if( location == "henny" ) { location = "Henrietta"; }

        const lunchResults = await getLunch( location );

        if( lunchResults.length == 0 ) {
            message.channel.send( "There are no locations in the **" + location + "** quadrant." );
        } else {
            let lunchSpotsMessage = "";

            message.channel.send("Here's your latest visits in " + location + "!");

            for (const lunchResult of lunchResults) {
                lunchSpotsMessage = lunchSpotsMessage + `**${lunchResult['name']}** - ${lunchResult['latest']}\n`;
            }
            message.channel.send(lunchSpotsMessage);
        }
    }
});

async function getLunch( location ) {
    const result = await axios.get( "https://penguinore.net/lunch_yap/api.php?search=last_visit&quadrant=" + location );
    return result.data;
}

//make sure this line is the last line
client.login(process.env.CLIENT_TOKEN); //login bot using token