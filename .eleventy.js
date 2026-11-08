const yaml = require("js-yaml");
const { default: Image, generateHTML } = require("@11ty/eleventy-img");

// Foto's die de klant uploadt worden bij elke build automatisch verkleind:
// - meerdere breedtes (400/800/1200 px), in WebP en JPEG
// - de browser kiest de kleinste versie die past
// - het origineel blijft in src/images/uploads staan (voor het beheerscherm)
async function foto(src, alt, sizes = "(max-width: 760px) 100vw, 400px") {
  if (!src) return "";
  const bestand = "src" + src;
  let metadata;
  try {
    metadata = await Image(bestand, {
      widths: [400, 800, 1200],
      formats: ["webp", "jpeg"],
      outputDir: "_site/images/foto",
      urlPath: "/images/foto/",
      sharpJpegOptions: { quality: 80 },
      sharpWebpOptions: { quality: 75 },
    });
  } catch (e) {
    // Bestand ontbreekt of is geen afbeelding: toon het origineel, bouw gaat door
    return `<img src="${src}" alt="${alt}" loading="lazy">`;
  }
  return generateHTML(metadata, { alt, sizes, loading: "lazy", decoding: "async" });
}

module.exports = function (c) {
  c.addDataExtension("yml", (s) => yaml.load(s));
  c.addPassthroughCopy({ "src/images": "images" });
  c.addPassthroughCopy({ "src/css": "css" });
  c.addPassthroughCopy({ "src/admin": "admin" });
  c.addPassthroughCopy({ "src/robots.txt": "robots.txt" });
  c.addFilter("nl2br", (s) => (s || "").replace(/\n/g, "<br>"));
  c.addNunjucksAsyncShortcode("foto", foto);
  return { dir: { input: "src", output: "_site", includes: "_includes" }, htmlTemplateEngine: "njk", markdownTemplateEngine: "njk" };
};
