/**
* Gets parts of speech for a sentence
* @param {String} text The text to get parts of speech for.
* @returns {Promise.<Object>} Resolves into a list of parts of speech. (Or rejects with an error)
* @example 
* var parts_of_speech  = await parts_of_speech("Sometimes I just want to code in JavaScript all day.");
* // ⇒
* // {entities: Array(1), sentiments: Array(1), documentInfo: {…}, wordFreq: Array(4), taggedText: '<span class="tag ADV">Sometimes</span> <span class…>all</span> <span class="tag DURATION">day</span>'}
function parts_of_speech(text) {
*/
function parts_of_speech(text) {
    return new Promise(async (resolve, reject) => {
      fetch("https://showcase-serverless.herokuapp.com/pos-tagger", {
        headers: {
          accept: "application/json",
          "content-type": "application/json",
        },
        body: JSON.stringify({ sentence: text }),
        method: "POST",
      })
        .then((res) => res.json())
        .then(resolve)
        .catch(reject);
    });
  }