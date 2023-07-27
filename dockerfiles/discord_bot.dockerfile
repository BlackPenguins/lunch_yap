FROM node

WORKDIR /app

COPY ./discord_bot /app/

RUN npm install dotenv

RUN npm install

EXPOSE 80

CMD ["node", "index.js"]