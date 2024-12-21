FROM node:18.4.0

WORKDIR /app

COPY ./package*.json ./

RUN npm install

COPY ./ /app/

EXPOSE 8080

CMD ["npm", "run", "serve"]