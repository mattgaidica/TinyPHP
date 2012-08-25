Tiny PHP is a little tool I put together that performs some “minification” on PHP code. Is it a trivial and completely academic exercise because PHP doesn’t benefit from being smaller like CSS or Javascript? Yes. But it’s still kind of cool.

What it does
------------
In short, the goal is to take a snippet, function, or page of PHP and condense it. It will replace variables, remove comments, and/or remove whitespace. To call this tool an obfuscator is not really right, but it does make code harder to read. It also has some fancy options that allow you to exclude certain variables from being replaced so your classe’s calls don’t get mushed up.

What it doesn’t do
------------------
The Tiny PHP tool does not attempt to minify function names, class names, or any references related to those objects. Were not trying to take your entire app and make it stupidly hard to maintain, there are lots of other programs out there to do that.

How I use it
-------------
There is really no reason to use this type of tool in production code. If you are just messing around though, it is sometimes nice to take a set of methods or functions, and condense them into four or five lines, if their only purpose is to simply exist and never be edited. Also, if an application has spiraled into a mess of variables that have absolutely no meaning, there becomes no difference between them being long and annoying, or short and sweet.

*Give it a try*: [Tiny PHP](http://labs.builtbyprime.com/tinyphp/)
