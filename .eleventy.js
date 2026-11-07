const yaml = require("js-yaml");
module.exports = function (c) {
  c.addDataExtension("yml", (s) => yaml.load(s));
  c.addPassthroughCopy({ "src/images": "images" });
  c.addPassthroughCopy({ "src/css": "css" });
  c.addPassthroughCopy({ "src/admin": "admin" });
  c.addPassthroughCopy({ "src/robots.txt": "robots.txt" });
  c.addFilter("nl2br", (s) => (s || "").replace(/\n/g, "<br>"));
  return { dir: { input: "src", output: "_site", includes: "_includes" }, htmlTemplateEngine: "njk", markdownTemplateEngine: "njk" };
};
