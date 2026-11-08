const yaml = require("js-yaml");
const { eleventyImageTransformPlugin } = require("@11ty/eleventy-img");
module.exports = function (c) {
  c.addDataExtension("yml", (s) => yaml.load(s));
  c.addPassthroughCopy({ "src/images/logo.png": "images/logo.png" });
  c.addPassthroughCopy({ "src/admin": "admin" });
  c.addPassthroughCopy({ "src/robots.txt": "robots.txt" });
  c.addFilter("nl2br", (s) => (s || "").replace(/\n/g, "<br>"));
  c.addFilter("inlineCss", () => require("fs").readFileSync("src/css/style.css", "utf8"));
  // Foto's automatisch verkleinen en naar WebP omzetten bij elke build.
  c.addPlugin(eleventyImageTransformPlugin, {
    extensions: "html",
    formats: ["webp", "jpeg"],
    widths: [480, 800, 1200],
    urlPath: "/img/",
    outputDir: "_site/img/",
    defaultAttributes: { loading: "lazy", decoding: "async", sizes: "(max-width: 760px) 100vw, 400px" },
  });
  return { dir: { input: "src", output: "_site", includes: "_includes" }, htmlTemplateEngine: "njk", markdownTemplateEngine: "njk" };
};
