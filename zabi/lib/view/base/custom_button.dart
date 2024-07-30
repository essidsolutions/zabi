import 'package:flutter/material.dart';
import 'package:get/get.dart';
import '../../util/dimensions.dart';

class CustomButton extends StatelessWidget {
  final double buttonWidth;
  final String buttonName;
  final double? fontSize;
  final VoidCallback onPressed;
  const CustomButton({
    super.key,
    required this.buttonWidth,
    required this.buttonName,
    this.fontSize,
    required this.onPressed,
  });

  @override
  Widget build(BuildContext context) {
    return SizedBox(
      width: buttonWidth,
      child: ElevatedButton(
        style: ElevatedButton.styleFrom(
          elevation: 20,
          backgroundColor: Theme.of(context).primaryColor,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(Dimensions.PADDING_SIZE_SMALL),
          ),
        ),
        onPressed: onPressed,
        child: Padding(
          padding: const EdgeInsets.all(Dimensions.PADDING_SIZE_DEFAULT),
          child: Text(
            buttonName.tr,
            style: TextStyle(
              color: Colors.white,
              fontSize: fontSize,
              fontWeight: FontWeight.bold,
            ),
          ),
        ),
      ),
    );
  }
}
