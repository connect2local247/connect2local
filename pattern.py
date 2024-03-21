def print_pattern(rows):
    for i in range(0, rows):
        # Print leading spaces
        for j in range(0, rows - i - 1):
            print("  ", end="")

        # Print stars
        for k in range(0, i + 1):
            print("* ", end=" ")  # Added a space after each star

        # Move to the next line after printing each row
        print("")

# Number of rows in the pattern
rows = 4
print_pattern(rows)
