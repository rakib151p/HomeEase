<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trie Autocomplete (Static)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .search-box {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .suggestions {
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            max-width: 300px;
            background: #fff;
            overflow: hidden;
            list-style: none;
            padding: 0;
        }
        .suggestions li {
            padding: 10px;
            cursor: pointer;
        }
        .suggestions li:hover {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <h1>Trie Autocomplete Demo</h1>
    <input
        type="text"
        id="search"
        class="search-box"
        placeholder="Type to search..."
    />
    <ul id="suggestions" class="suggestions"></ul>

    <script>
        // Sample Data
        const words = [
            "apple", "app", "application", "banana", "band", 
            "bat", "batman", "battle", "cat", "cater", 
            "caterpillar", "dog", "dolphin", "donkey", "dragon"
        ];

        // Trie Implementation
        class TrieNode {
            constructor() {
                this.children = {};
                this.isEndOfWord = false;
            }
        }

        class Trie {
            constructor() {
                this.root = new TrieNode();
            }

            // Insert a word into the Trie
            insert(word) {
                let current = this.root;
                for (const char of word) {
                    if (!current.children[char]) {
                        current.children[char] = new TrieNode();
                    }
                    current = current.children[char];
                }
                current.isEndOfWord = true;
            }

            // Get suggestions based on prefix
            startsWith(prefix) {
                let current = this.root;
                for (const char of prefix) {
                    if (!current.children[char]) {
                        return [];
                    }
                    current = current.children[char];
                }

                const results = [];
                this.collectWords(current, prefix, results);
                return results;
            }

            // Helper function to collect words
            collectWords(node, prefix, results) {
                if (node.isEndOfWord) {
                    results.push(prefix);
                }
                for (const char in node.children) {
                    this.collectWords(node.children[char], prefix + char, results);
                }
            }
        }

        // Initialize the Trie and insert words
        const trie = new Trie();
        words.forEach(word => trie.insert(word));

        // DOM Elements
        const searchBox = document.getElementById('search');
        const suggestionsBox = document.getElementById('suggestions');

        // Handle input event for search
        searchBox.addEventListener('input', () => {
            const query = searchBox.value;

            // Clear previous suggestions
            suggestionsBox.innerHTML = '';

            if (query.length > 0) {
                const suggestions = trie.startsWith(query);

                // Display suggestions
                suggestions.forEach(suggestion => {
                    const li = document.createElement('li');
                    li.textContent = suggestion;

                    // Add click functionality to select a suggestion
                    li.addEventListener('click', () => {
                        searchBox.value = suggestion;
                        suggestionsBox.innerHTML = ''; // Clear suggestions after selection
                    });

                    suggestionsBox.appendChild(li);
                });
            }
        });
    </script>
</body>
</html>
