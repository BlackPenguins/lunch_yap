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
        let quadrant = message.content.replace( "lunch in", "" ).trim();
        if( quadrant == "henny" ) { quadrant = "Henrietta"; }

        const lunchResponse = await getVisits( quadrant );

        if( lunchResponse.length == 0 ) {
            message.channel.send( "There are no locations in the **" + quadrant + "** quadrant." );
        } else {
            let lunchSpotsMessage = "";

            message.channel.send("Here's your latest visits in " + quadrant + "!");

            for (const lunchResult of lunchResponse) {
                lunchSpotsMessage = lunchSpotsMessage + `**${lunchResult['name']}** - ${lunchResult['latest']}\n`;
            }
            message.channel.send(lunchSpotsMessage);
        }
    } else if (message.content.startsWith("!visit ")) {
        if( message.author.username != "Gamerkd" ) {
            message.channel.send( "You are not Matt Miles!" );
        } else {
            let location = message.content.replace("!visit ", "").trim();

            let visitResponse = await visitLocation(location);
            console.log("Location", visitResponse );

            if( visitResponse == undefined ) {
                visitResponse = "Response was empty from Penguinore. Look into this.";
            }

            message.channel.send(visitResponse);
        }
    }
});

async function getVisits( quadrant ) {
    const result = await axios.get( "https://penguinore.net/lunch_yap/api.php?mode=search_last_visit&quadrant=" + quadrant );
    return result.data;
}

async function visitLocation( location ) {
    const result = await axios.get( "https://penguinore.net/lunch_yap/api.php?mode=add_frequency&location=" + location );
    return result.data.message;
}

//make sure this line is the last line
client.login(process.env.CLIENT_TOKEN); //login bot using token