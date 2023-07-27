FROM node

WORKDIR /app

RUN rm -rf node_modules

COPY ./discord_bot/package.json .

RUN npm install dotenv

RUN npm install

COPY ./discord_bot/index.js .

EXPOSE 80

CMD ["node", "index.js"]