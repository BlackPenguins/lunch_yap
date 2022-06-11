require('dotenv').config(); //initialize dotenv
const axios = require('axios'); //add this line at the top
const {Client, Intents} = require('discord.js');

const client = new Client({intents: [Intents.FLAGS.GUILDS, Intents.FLAGS.GUILD_MESSAGES]});

client.on('ready', () => {
    console.log(`Logged in as ${client.user.tag}!`);
});

client.on("messageCreate", async (message) => {
    if (message.author.bot) return false;

    const incomingMessage = message.content;

    console.log(`Message from ${message.author.username}: ${incomingMessage}`);

    switch ( incomingMessage ) {
        case "ping":
            message.reply("Pong Bitch!");
            break;
    }

    if ( incomingMessage.startsWith("lunch in") ||
        incomingMessage.startsWith("!visits") ||
        incomingMessage.startsWith("!history") ||
        incomingMessage.startsWith("!plan") ) {

        const lunchResponse = await getVisits();

        if (lunchResponse.length == 0) {
            message.channel.send("There are no locations in **The Grand Lunch Plan**.");
        } else {
            let lunchSpotsMessage = "";

            const isLunchPlan = incomingMessage.startsWith("!plan");


            let lunchLocationsCount = 0;

            const showVisits = incomingMessage.startsWith("lunch in") || incomingMessage.startsWith("!visits") || incomingMessage.startsWith("!history");
            const showNonVisits = incomingMessage.startsWith("lunch in") || incomingMessage.startsWith("!visits") || incomingMessage.startsWith("!plan");

            for (const lunchResult of lunchResponse) {
                if (lunchResult['visit_count'] > 0 && showVisits) {
                    lunchSpotsMessage = lunchSpotsMessage + `• **${lunchResult['name']}** - Last Visit: ${lunchResult['time_ago_label']} (${lunchResult['visit_count']} total)\n`;
                    lunchLocationsCount++;
                } else if ( lunchResult['visit_count'] == 0 && showNonVisits) {
                    const visitsLabel = isLunchPlan ? "" : " - NO VISITS";
                    lunchSpotsMessage = lunchSpotsMessage + `• **${lunchResult['name']}** ${visitsLabel}\n`;
                    lunchLocationsCount++
                }
            }

            if( isLunchPlan ) {
                message.channel.send("Here's your " + lunchLocationsCount + " locations for the lunch plan!");
                // allow other people to add, default henny
            } else {
                message.channel.send("Here's your " + lunchLocationsCount + " latest visits!");
            }

            message.channel.send(lunchSpotsMessage);
        }
    } else if (incomingMessage.startsWith("!visited ")) {
        if( message.author.username != "Gamerkd" ) {
            message.channel.send( "You are not Matt Miles!" );
        } else {
            let location = incomingMessage.replace("!visited ", "").trim();

            let visitResponse = await visitLocation(location);

            if( visitResponse == undefined ) {
                visitResponse = "Response was empty from Penguinore. Look into this.";
            }

            message.channel.send(visitResponse);
        }
    } else if (incomingMessage.startsWith("!addLocation ")) {
        const author = message.author.username;
        let location = incomingMessage.replace("!addLocation ", "").trim();

        let visitResponse = await addLocation(location,  author);

        if( visitResponse == undefined ) {
            visitResponse = "Response was empty from Penguinore. Look into this.";
        }

        message.channel.send(visitResponse + " It was added by **" + author  + "**. I'm watching you **" + author + "**." );
    } else if ( incomingMessage == "!help" ) {
        message.channel.send( "Yap is a lunch tracking tool that we use to determine where to go to lunch and which places we have not visited yet. YapBot will retrieve information from https://penguinore.net/lunch_yap/yap.php. It is meant to be a complete rip-off of Yelp but tailored more to us with less clutter and much less exploitation of small businesses.\n\n" +
            "**YapBot Commands:**\n" +
            "**lunch plan** or **!visits** - Display visits and non-visits.\n" +
            "**!history** - Display visited locations.\n" +
            "**!plan** - Display locations that have not been visited.\n" +
            "**!visited** - Mark this location as visited today. (ADMIN ONLY)\n" +
            "**!addLocation [location]** - Adds [location] to the lunch plan.\n" +
            "**!help** - This command list.\n\n" +
            "**Future Plans:** Slash commands." );
    }

});

async function getVisits( ) {
    const result = await axios.get( "https://penguinore.net/lunch_yap/api.php?mode=search_visits");
    return result.data;
}

async function visitLocation( location ) {
    const result = await axios.get( "https://penguinore.net/lunch_yap/api.php?mode=add_frequency&location=" + location );
    return result.data.message;
}

async function addLocation( location, author ) {
    const result = await axios.get( "https://penguinore.net/lunch_yap/api.php?mode=add_location&location=" + location + "&author=" + author );
    return result.data.message;
}

//make sure this line is the last line
client.login(process.env.CLIENT_TOKEN); //login bot using token