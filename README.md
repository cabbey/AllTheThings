# AllTheThings minecraft bedrock world and script

## Raison d'être

Working on bedrock-viz it has become imperative that we have a world that has *all the things* placed it in so that we can interpret the leveldb properly.

## You put binary files in git? 🤨 

Yeah, ok, maybe not the best idea. Github in this case is really all about distribution and coordination. And the script is the valuable part. It shoud be able to be revision controlled just fine.

## How do I use it?

Check out the repo and symlink the AllTheThings folder into your worlds folder. Link the server.properties into the server and start it in a way that you can feed commands into it, I use a fifo pipe inside a docker environment.

In a terminal:
```
mkfifo in
docker run -it --rm --entrypoint /bin/bash --name working -v $PWD:/mnt -w /mnt itzg/minecraft-bedrock-server
tail -f in | ./bedrock_server
```

Then in a separate console tab:
```
php scripts/popuate.php ./in
```

To shut the world down:
```
echo "stop" >> in
```
then hit ctrl-c in terminal that had `tail -f` running in it.

## I'm getting errors or having other problems

### Where did `bedrock_server` come from?

You need to [get it from Mojang](https://www.minecraft.net/en-us/download/server/bedrock).

### Where does blocks.json come from?

You also need to get this from Mojang. [I recommend this page for the link to the current, or whatever version you want to work from, resource pack](https://bedrock.dev/packs).

### The first step where it cleans out the existing auto built content doesn't work, I get tons of errors about nto being able to place blocks outside of the world.

That message is poorly worded. You need to have another user connected to the world so that the chunks in question are loaded in. The population script will attempt to teleport them to the right place so that a sim distance 4 world will have all the parts it's going to work on loaded. Note that currently it expects me to be there, so search and replace `originalCabbey` for your own user id in the script.

### I get an error from cmd.exe when I do the above, shoud I use PowerShell?

Sorry, windows users are on their own here until one of you contributes back some equivalent process. I'm a unix guy.

### I get "Syntax error: Unexpected thing at "ntainer 0 >>thing<<"

Yeah, so do I. There are a bunch of cases where the block/tile and the item/entity have different names, or may not even exist, and we need to update the script to know about those still.


## TODO

0. clean up the script, add error handling, etc.
1. make server properties more generic
2. script up the manually placed items
3. figure out the orientation issues
4. script setting ticks rate to 0... was only able to do it from client so far? :headscratch:
5. parameterize the user that gets tp'd... or figure out a way to not need that.

## License

[CC BY-NC 4.0](https://creativecommons.org/licenses/by-nc/4.0/)