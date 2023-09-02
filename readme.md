# Meme Daily
An excellent way to share meme with your friends once a day.

## Configuration

- After cloning this repo you need to generate Google credential by creating a user at gcloud. Save them in ```credentials.json```.
- Set up your Slack application and place a newly generated token in ```env.php```. You need to grant the app with permission to writing messages and editing files.

## Launch
Use the command below to send a random meme to the Slack channel.
```bash
php index.php
```

## Restrictions
The memes must be in ```.jpg``` or ```.jpeg``` format.
