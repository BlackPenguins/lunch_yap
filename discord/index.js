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
        let quadrant = incomingMessage
            .replace( "lunch in", "" )
            .replace( "!visits", "" )
            .replace( "!history", "" )
            .replace( "!plan", "" )
            .trim();
        if( quadrant.toLowerCase() == "henny" ) { quadrant = "Henrietta"; }

        if( quadrant == "" ) {
            message.channel.send( "You need to specify a quadrant." );
        } else {
            const lunchResponse = await getVisits(quadrant);

            if (lunchResponse.length == 0) {
                message.channel.send("There are no locations in the **" + quadrant + "** quadrant.");
            } else {
                let lunchSpotsMessage = "";

                const isLunchPlan = incomingMessage.startsWith("!plan");

                if( isLunchPlan ) {
                    message.channel.send("Here's your lunch plan for " + quadrant + "!");
                    // count them, use bullets
                    // allow other people to add, default henny
                } else {
                    message.channel.send("Here's your latest visits in " + quadrant + "!");
                }

                const showVisits = incomingMessage.startsWith("lunch in") || incomingMessage.startsWith("!visits") || incomingMessage.startsWith("!history");
                const showNonVisits = incomingMessage.startsWith("lunch in") || incomingMessage.startsWith("!visits") || incomingMessage.startsWith("!plan");

                for (const lunchResult of lunchResponse) {
                    if (lunchResult['visit_count'] > 0 && showVisits) {
                        lunchSpotsMessage = lunchSpotsMessage + `**${lunchResult['name']}** - Last Visit: ${lunchResult['time_ago_label']} (${lunchResult['visit_count']} total)\n`;
                    } else if ( lunchResult['visit_count'] == 0 && showNonVisits) {
                        const visitsLabel = isLunchPlan ? "" : " - NO VISITS";
                        lunchSpotsMessage = lunchSpotsMessage + `**${lunchResult['name']}** ${visitsLabel}\n`;
                    }
                }
                message.channel.send(lunchSpotsMessage);
            }
        }
    } else if (incomingMessage.startsWith("!visited ")) {
        if( message.author.username != "Gamerkd" ) {
            message.channel.send( "You are not Matt Miles!" );
        } else {
            let location = incomingMessage.replace("!visited ", "").trim();

            let visitResponse = await visitLocation(location);
            console.log("Location", visitResponse );

            if( visitResponse == undefined ) {
                visitResponse = "Response was empty from Penguinore. Look into this.";
            }

            message.channel.send(visitResponse);
        }
    } else if ( incomingMessage == "!help" ) {
        message.channel.send( "Yap is a lunch tracking tool that we use to determine where to go to lunch and which places we have not visited yet. YapBot will retrieve information from https://penguinore.net/lunch_yap/yap.php. It is meant to be a complete rip-off of Yelp but tailored more to us with less clutter and much less exploitation of small businesses.\n\n" +
            "**YapBot Commands:**\n" +
            "**lunch in [quadrant]** or **!visits [quadrant]** - Display visits and non-visits for a quadrant.\n" +
            "**!history [quadrant]** - Display visited locations for a quadrant.\n" +
            "**!plan [quadrant]** - Display locations that have not be visited for a quadrant.\n" +
            "**!visited [location]** - Mark this location as visited today. (ADMIN ONLY)\n" +
            "**!help** - This command list." );
    }

});

async function getVisits( quadrant ) {
    const result = await axios.get( "https://penguinore.net/lunch_yap/api.php?mode=search_visits&quadrant=" + quadrant );
    return result.data;
}

async function visitLocation( location ) {
    const result = await axios.get( "https://penguinore.net/lunch_yap/api.php?mode=add_frequency&location=" + location );
    return result.data.message;
}

//make sure this line is the last line
client.login(process.env.CLIENT_TOKEN); //login bot using token