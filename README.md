# PHP Board Generator

## Project Description

This project aims to create a PHP application that generates a board with dimensions defined by the user, filled with random values for terrain, energia, and lighting. The board is displayed as a table, and a summary of the number of cells with specific attribute values is also generated. The application allows users to input the number of columns and rows through an HTML form.

## Features

- Generates a board with dimensions specified by the user (x, y) within the range of 10 to 50.
- Randomly assigns terrain, energia, and lighting values to each cell on the board.
- Automatically distributes lighting throughout the board.
- Provides a summary of the number of cells with various values for energia, lighting, and terrain.
- Interactive table: clicking on a cell displays the terrain, energia, and lighting values in the console.

## How to Use

1. Copy the code into a PHP file (e.g., `main.php`).
2. Create an HTML file (e.g., `index.html`) with the provided HTML code to serve as the user interface.
3. Run a local server (e.g., XAMPP or MAMP) and open the HTML file in a browser.
4. Enter the x and y values in the form and submit to generate the board.

## Example

Board generated for dimensions 20 x 20:

| Terrain | Energia | Lighting |
|---------|---------|----------|
| 2       | 6       | 10       |
| 5       | 0       | 0        |
| ...     | ...     | ...      |

Summary of the number of cells with specific attribute values:

| Value | Number of Lighted Cells | Number of Energia Cells | Number of Terrain Cells |
|-------|-------------------------|-------------------------|-------------------------|
| 0     | 15                      | 7                       | 10                      |
| 1     | 20                      | 5                       | 15                      |
| ...   | ...                     | ...                     | ...                     |

## Requirements

- PHP 7.0 or higher
- Local server (e.g., XAMPP, MAMP)


## License

This project is licensed under the MIT License.
